<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

if (isset($_POST["inputEmail"]) and $_POST["inputEmail"] !== "" and isset($_POST["inputSenha"]) and $_POST["inputSenha"] !== ""){

    try{
        $sql = <<<SQL
        SELECT email, passHash
        FROM T6E3_cadastros
        WHERE email = ?
        SQL;
    
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST["inputEmail"]]);
    }catch(Exception $e){
        exit('Ocorreu uma falha: ' . $e->getMessage());
    }

    $row = $stmt->fetch();

    $emailSaved = $row['email'];
    $passHash = $row['passHash'];

    if ($_POST["inputEmail"] === $emailSaved and password_verify($_POST["inputSenha"], $passHash)){
        header("Location: ex3-testLogin-success.html");
        exit();
    }else {
        header("Location: ex3-testLogin.html");
        exit();
    }

} else {
    header("Location: ex3-testLogin.html");
    exit();
}
?>