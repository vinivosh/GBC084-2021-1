<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

try{
    $sql = <<<SQL
    SELECT codigo, nome, sexo, email, telefone, cep, logradouro, cidade, estado
    FROM T6E4_pessoa
    SQL;

    $stmt1 = $pdo->query($sql);
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
    <title>Ex. 4 — Exibindo Pacientes Cadastrados</title>
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
            /* table-layout: fixed; */
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
        <h1 class="mb-5">Pacientes Cadastrados</h1>

        <main>
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Sexo</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>CEP</th>
                        <th>Logradouro</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Peso</th>
                        <th>Altura</th>
                        <th>Tipo Sanguíneo</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($row1 = $stmt1->fetch()){
                        // Tratando entradas para evitar ataques XSS, somente as que são campos produzidos pelo usuário através do formulário
                        $nome = htmlspecialchars($row1['nome']);
                        $email = htmlspecialchars($row1['email']);
                        $cep = htmlspecialchars($row1['cep']);
                        $logradouro = htmlspecialchars($row1['logradouro']);
                        $cidade = htmlspecialchars($row1['cidade']);

                        try{                        
                            $sql = <<<SQL
                            SELECT peso, altura, tipoSanguineo
                            FROM T6E4_paciente
                            WHERE codigo = {$row1['codigo']}
                            SQL;
                        
                            $stmt2 = $pdo->query($sql);                         
                            $row2 = $stmt2->fetch();
                        }catch(Exception $e){
                            exit('Ocorreu uma falha: ' . $e->getMessage());
                        }

                        echo <<<HTML
                            <tr>
                                <td>$nome</td>
                                <td>{$row1['sexo']}</td>
                                <td>$email</td>
                                <td>{$row1['telefone']}</td>
                                <td>$cep</td>
                                <td>$logradouro</td>
                                <td>$cidade</td>
                                <td>{$row1['estado']}</td>
                                <td>{$row2['peso']}</td>
                                <td>{$row2['altura']}</td>
                                <td>{$row2['tipoSanguineo']}</td>
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