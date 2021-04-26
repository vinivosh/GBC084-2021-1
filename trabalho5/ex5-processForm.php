<?php
// Funções auxiliares
function carregaString($arquivo){
    $arq = fopen($arquivo, "r");
    $string = fgets($arq);
    fclose($arq);
    return $string;
}

if (isset($_POST["inputEmail"]) and $_POST["inputEmail"] !== "" and isset($_POST["inputSenha"]) and $_POST["inputSenha"] !== ""){
    $fileEmail = './email.txt';
    $filePassHash = './senhaHash.txt';

    $emailSaved = carregaString($fileEmail);
    $passHash = carregaString($filePassHash);

    if ($_POST["inputEmail"] === $emailSaved and password_verify($_POST["inputSenha"], $passHash)){
        header("Location: ex5-success.html");
        exit();
    }else {
        header("Location: ex5.html");
        exit();
    }

} else {
    header("Location: ex5.html");
    exit();
}
?>