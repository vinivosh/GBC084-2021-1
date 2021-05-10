<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

$cep = $bairro = $logradouro = $cidade = $estado = "";

if (isset($_POST["inputCEP"])) $cep = $_POST["inputCEP"];
if (isset($_POST["inputBairro"])) $bairro = $_POST["inputBairro"];
if (isset($_POST["inputLogradouro"])) $logradouro = $_POST["inputLogradouro"];
if (isset($_POST["inputCid"])) $cidade = $_POST["inputCid"];
if (isset($_POST["inputEstado"])) $estado = $_POST["inputEstado"];

try{
    // Usando prepared statements para evitar ataques de SQL injection, já que os dados inseridos vieram de um formulário preenchido
    $sql = <<<SQL
    INSERT INTO T6E2_endereco (cep, bairro, logradouro, cidade, estado)
    VALUES (?, ?, ?, ?, ?)
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cep, $bairro, $logradouro, $cidade, $estado]);

    header("location: ex2-showFormResults.php");
    exit();
    
} catch(Exception $e){
    if ($e->errorInfo[1] === 1062) exit('Dados duplicados: ' . $e->getMessage());
    else exit('Falha ao cadastrar os dados: ' . $e->getMessage());
    
}

?>