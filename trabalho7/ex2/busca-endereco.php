<?php

//
// Código fornecido pelo professor Daniel Furtado e modificado por Vinícius Henrique para utilizar
// um db MySQL ao invés da array $enderecos
//

require "conexaoMysql.php";
$pdo = mysqlConnect();
$cep = $_GET['cep'] ?? '';

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

$sql = <<<SQL
    SELECT *
    FROM T7E2_endereco
    WHERE cep = ?
    SQL;

$stmt = $pdo->prepare($sql);
$stmt->execute($cep);

// $endereco1 = new Endereco('Av João Naves', 'Santa Mônica', 'Uberlândia');
// $endereco2 = new Endereco('Av Floriano Peixoto', 'Centro', 'Uberlândia');
// $endereco3 = new Endereco('Av Afonso Pena','Martins', 'Uberlândia');

// $enderecos = array(
//   '38400-100' => $endereco1,
//   '38400-200' => $endereco2,
//   '38400-300' => $endereco3
// );


  
$endereco = array_key_exists($cep, $enderecos) ? 
  $enderecos[$cep] : new Endereco('', '', '');
  
echo json_encode($endereco);