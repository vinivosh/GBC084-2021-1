<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Ex. 1 — Processando o Formulário</title>
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
            padding: 5px;
            border: 1px solid;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="container my-3">
        <h1 class="mb-4">Formulário Responsivo Processado com <strong>PHP</strong></h1>

        <main>
            <?php
            $cep = $_POST["inputCEP"];
            $bairro = $_POST["inputBairro"];
            $logradouro = $_POST["inputLogradouro"];
            $cidade = $_POST["inputCid"];
            $estado = $_POST["inputEstado"];

            echo <<<HTML
            <div class="row g-2">
                <div class="col-md-2">
                    <p><strong>CEP:</strong> $cep</p>
                </div>
                <div class="col-md-2">
                    <p><strong>Bairro:</strong> $bairro</p>
                </div>
                <div class="col-md-3">
                    <p><strong>Logradouro:</strong> $logradouro</p>
                </div>
                <div class="col-md-3">
                    <p><strong>Cidade:</strong> $cidade</p>
                </div>
                <div class="col-md-2">
                    <p><strong>Estado:</strong> $estado</p>
                </div>
            </div>
            
            HTML;         
            ?>

        </main>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>