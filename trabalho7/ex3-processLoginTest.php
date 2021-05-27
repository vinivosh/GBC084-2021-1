<?php
    require "conexaoMysql.php";
    $pdo = mysqlConnect();

    class RequestResponse{
        public $success;
        public $destination;

        function __construct($success, $destination){
            $this->success = $success;
            $this->destination = $destination;
        }
    }
    
    if (isset($_POST["inputEmail"]) and $_POST["inputEmail"] !== "" and isset($_POST["inputSenha"]) and $_POST["inputSenha"] !== ""){

        try{
            $sql = <<<SQL
            SELECT email, passHash
            FROM T7E3_cadastros
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
            $reqResponse = new RequestResponse(true, "ex3-testLogin-success.html");
        }else {
            $reqResponse = new RequestResponse(false, NULL);
        }

        // echo "[Debug] inputEmail = " . $_POST["inputEmail"] . "\n[Debug] inputSenha = " . $_POST["inputSenha"] . "\n[Debug] emailSaved = $emailSaved" . "\n[Debug] passHash = $passHash";
        echo json_encode($reqResponse);

        } else {
            header("Location: ex3-testLogin.html");
            exit();
        }
        
    
?>