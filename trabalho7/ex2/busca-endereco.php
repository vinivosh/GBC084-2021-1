<?php

//
// Código fornecido pelo professor Daniel Furtado e modificado por Vinícius Henrique para utilizar
// um db MySQL ao invés da array hardcoded $enderecos
//

require "conexaoMysql.php";
$pdo = mysqlConnect();
$cep = $_GET["cep"] ?? '';

class Endereco
{
  public $rua;
  public $bairro;
  public $cidade;

  function __construct($rua, $bairro, $cidade)
  {
    $this->rua = $rua;
    $this->bairro = $bairro; 
    $this->cidade = $cidade;
  }
}

// Utilizando prepared statements para proteção contra um ataque de injeção SQL, já que o campo "cep" foi obtido de um fomulário preenchido pelo usuário
$sql = <<<SQL
    SELECT rua, bairro, cidade
    FROM T7E2_endereco
    WHERE cep = ?
    SQL;

$stmt = $pdo->prepare($sql);
$stmt->execute([$cep]);

$row = $stmt->fetch();

$endereco = new Endereco($row['rua'], $row['bairro'], $row['cidade']);

echo json_encode($endereco);