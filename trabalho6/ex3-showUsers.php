<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

try{
    $sql = <<<SQL
    SELECT email, passHash
    FROM T6E3_cadastros
    SQL;

    $stmt = $pdo->query($sql);
}catch(Exception $e){
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Ex. 3 — Exibindo Usuários Cadastrados</title>
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

    <div class="container my-3">
        <h1 class="mb-5">Usuários Cadastrados</h1>

        <main>
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>E-mail</th>
                        <th>Hash da Senha</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    while ($row = $stmt->fetch()){
                        // Tratando o email da tabela para evitar ataques XSS, já que é um campo produzido pelo usuário através do formulário
                        $email = htmlspecialchars($row['email']);

                        echo <<<HTML
                            <tr>
                                <td>$email</td>
                                <td>{$row['passHash']}</td>
                            </tr>
                        HTML;
                    }
                    ?>

                </tbody>
            </table>

            

        </main>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>