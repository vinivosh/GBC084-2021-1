<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Ex. 3 — Processando o Cadastro</title>
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
    </style>
</head>
<body>

    <div class="container my-3">
        <h1 class="mb-4">Processamento e Armazenamento do Cadastro com <strong>PHP</strong></h1>

        <main>
            <?php
            require "conexaoMysql.php";
            $pdo = mysqlConnect();

            if (isset($_POST["inputEmail"]) and isset($_POST["inputSenha"])){
                $email = $_POST["inputEmail"];
                $senha = $_POST["inputSenha"];

                $passHash = password_hash($senha, PASSWORD_DEFAULT);

                try{
                    // Usando prepared statements para evitar ataques de SQL injection, já que os dados inseridos vieram de um formulário preenchido
                    $sql = <<<SQL
                    INSERT INTO T6E3_cadastros (email, passHash)
                    VALUES (?, ?)
                    SQL;

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$email, $passHash]);
                }catch (Exception $e){
                    if ($e->errorInfo[1] === 1062) exit('Dados duplicados: ' . $e->getMessage());
                    else exit('Falha ao cadastrar os dados: ' . $e->getMessage());
                }

                echo <<<HTML
                    <div class="row g-2">
                        <div class="col-md-6 bg-success">
                            <p>E-mail salvo com sucesso.</p>
                        </div>
                        <div class="col-md-6 bg-success">
                            <p>Senha salva com sucesso.</p>
                        </div>
                    </div>
                HTML;
            } else{
                echo <<<HTML
                <div class="row g-2">
                    <div class="col-md-12 bg-danger">
                        <p>Campos <em>e-mail</em> e <em>senha</em> precisam ser preenchidos!</p>
                    </div>
                </div>                
                HTML;
            }
            ?>
        </main>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>