<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Ex. 2 — Lista de Produtos Aleatórios</title>
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

        h2 {
            margin-bottom: 20px;
            font-weight: bold !important;
            color: hsl(202, 63%, 62%);
        }
    </style>
</head>
<body>
    <div class="container my-3">
        <h1 class="mb-4">Lista de Produtos Aleatórios com <strong>PHP</strong></h1>

        <main>
            <?php
            $products = ['Lápis 2B', 'Borracha Branca', 'Tesoura', 'Apontador', 'Caneta Hidrográfica', 'Lápis de Colorir', 'Grafite 0,7mm', 'Lapiseira 0,7mm', 'Caneta Esferográfica Azul', 'Caneta Esferográfica Preta'];
            $descriptions = ['Lápis para escrita convencional do tipo 2B', 'Borracha comum para apagar escritas com grafite', 'Tesoura pequena com lâmina reta', 'Apontador para lápis com tamanho comum', 'Caneta hidrográfica para colorir, com 12 cores', 'Lápis para colorir, com 12 cores', 'Grafite para lapiseiras 0,7mm, 24 unidades', 'Lapiseira comum que utiliza grafites de 0.7mm', 'Caneta esferográfica de tinta azul e corpo transparente', 'Caneta esferográfica de tinta preta e corpo transparente'];

            if (isset($_GET["qde"]) and $_GET["qde"] > 0){
                echo <<<HTML
                    <table class='table table-dark table-striped'>
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                    <tbody>
                HTML;

                for($i = 0; $i < $_GET["qde"]; $i++){
                    $rand = rand(0,9);
                    $number = $i + 1;
                    echo <<<HTML
                        <tr>
                            <td><strong>$number</strong></td>
                            <td>$products[$rand]</td>
                            <td>$descriptions[$rand]</td>
                        </tr>
                    HTML;
                }
                

                echo <<<HTML
                    </tbody>
                    </table>
                HTML;
            } else{
                echo <<<HTML
                <h2>Instruções</h2>
                
                <p>Insira "?qde=N" no fim da URL desta página, onde N é um número inteiro maior que zero, e poderá visualizar os produtos!</p>
                HTML;
            }                     
            ?>

        </main>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>