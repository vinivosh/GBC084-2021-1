<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Ex. 5 — Verificando Login</title>
    <style>
        html,body,.container {
            font-size: 16pt;
            color: rgb(245, 245, 245);
            background-color: rgb(38, 38, 38) !important;
        }

        h1 {
            font-size: 2em;
            font-weight: bold !important;
            color: hsl(202, 63%, 51%);
        }

        p {
            margin: 12px;
            text-shadow: 2px 2px rgba(0, 0, 0, 15%);
        }

        table {
            table-layout: fixed;
            word-wrap: break;
            border: 2px solid;
        }

        table td {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
    </style>
</head>
<body>

    <?php
    // Funções auxiliares
    function carregaString($arquivo){
        $arq = fopen($arquivo, "r");
        $string = fgets($arq);
        fclose($arq);
        return $string;
    }
    ?>

    <div class="container my-3">
        <h1 class="mb-5">Ex. 5 — Verificando Login</h1>

        <main>
            <?php

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

                // echo <<<HTML
                // <div class="row mx-0 mt-0 mb-3">
                //     <div class="col-md-12 bg-success my-0 mx-0">
                //         <p>Campos <em>e-mail</em> e <em>senha</em> carregados com sucesso!</p>
                //     </div>
                // </div>
                // <!--  -->
                // <table class="table table-dark">
                //     <tbody>
                //         <tr>
                //             <td> <strong>E-mail:</strong> </td>
                //             <td> $emailSaved </td>
                //         </tr>
                //         <tr>
                //             <td> <strong>Hash da senha:</strong> </td>
                //             <td> $passHash </td>
                //         </tr>
                //     </tbody>                
                // </table>

                // HTML;

            } else {
                header("Location: ex5.html");
                exit();
            }
            ?>

        </main>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>
