<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $sexo = $email = $telefone = $cep = $logradouro = $cidade = $estado = "";

if (isset($_POST["nome"])) $nome = $_POST["nome"];
if (isset($_POST["sexo"])) $sexo = $_POST["sexo"];
if (isset($_POST["email"])) $email = $_POST["email"];
if (isset($_POST["telefone"])) $telefone = $_POST["telefone"];
if (isset($_POST["cep"])) $cep = $_POST["cep"];
if (isset($_POST["logradouro"])) $logradouro = $_POST["logradouro"];
if (isset($_POST["cidade"])) $cidade = $_POST["cidade"];
if (isset($_POST["estado"])) $estado = $_POST["estado"];
if (isset($_POST["peso"])) $peso = $_POST["peso"];
if (isset($_POST["altura"])) $altura = $_POST["altura"];
if (isset($_POST["tipoSanguineo"])) $tipoSanguineo = $_POST["tipoSanguineo"];

try{
    // Usando prepared statements para evitar ataques de SQL injection, já que os dados inseridos vieram de um formulário preenchido
    $sql = <<<SQL
    INSERT INTO T6E4_pessoa (nome, sexo, email, telefone, cep, logradouro, cidade, estado)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    SQL;

    $pdo->beginTransaction();

    $stmt = $pdo->prepare($sql);
    if (! $stmt->execute([$nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $estado]))
        throw new Exception('Falha na operação de inserção na tabela "Pessoa"');

    // Obtém o ID da pessoa recém adicionada
    $lastID = $pdo->lastInsertId();

    $sql = <<<SQL
    INSERT INTO T6E4_paciente (peso, altura, tipoSanguineo, codigo)
    VALUES (?, ?, ?, ?)
    SQL;

    $stmt = $pdo->prepare($sql);
    if (! $stmt->execute([$peso, $altura, $tipoSanguineo, $lastID]))
        throw new Exception('Falha na operação de inserção na tabela "Paciente"');

    // Se bem sucedido, commitar as mudanças no DB
    $pdo->commit();

    header("location: ex4.html");
    exit();
    
} catch(Exception $e){
    // Reverter as operações se algum erro ocorreu
    $pdo->rollBack();
    if ($e->errorInfo[1] === 1062) exit('Dados duplicados: ' . $e->getMessage());
    else exit('Falha ao cadastrar os dados: ' . $e->getMessage());
    
}

?>