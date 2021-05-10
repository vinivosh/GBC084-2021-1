<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

try{
    $sql = <<<SQL
    SELECT cep, bairro, logradouro, cidade, estado
    FROM T6E2_endereco
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
    <title>Ex. 2 — Exibindo o formulário</title>
    <style>
        html,body,.container {
            font-size: 14pt;
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
        <h1 class="mb-4">Formulário Responsivo Processado com <strong>PHP</strong> e <strong>MySQL</strong></h1>

        <main>
            <h2>Endereços cadastrados</h2>

            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>CEP</th>
                        <th>Bairro</th>
                        <th>Logradouro</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    while ($row = $stmt->fetch()){
                        // Tratando os dados da tabela para evitar ataques XSS, já que todos, exceto "estado", foram produzidos pelo usuário através do formulário
                        $cep = htmlspecialchars($row['cep']);
                        $bairro = htmlspecialchars($row['bairro']);
                        $logradouro = htmlspecialchars($row['logradouro']);
                        $cidade = htmlspecialchars($row['cidade']);
                        // $estado = htmlspecialchars($row['estado']);

                        echo <<<HTML
                            <tr>
                                <td>$cep</td>
                                <td>$bairro</td>
                                <td>$logradouro</td>
                                <td>$cidade</td>
                                <td>{$row['estado']}</td>
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