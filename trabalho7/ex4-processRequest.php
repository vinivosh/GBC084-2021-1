<?php

    class InfoDoc {
        public $nome = '';
        public $telefone = '';

        function __construct($nome, $telefone){
            $this->nome = $nome;
            $this->telefone = $telefone;
        }
    }

    require "conexaoMysql.php";
    $pdo = mysqlConnect();

    $especialidade = $_GET["esp"] ?? '';

    // Usando prepared statements para evitar ataques de injeção SQL. Mesmo o valor vindo de um select, eu imagino que seja possível o usuário acessar manualmente um link com um valor estranho no url, injetando SQL dessa maneira.
    $sql = <<<SQL
    SELECT nome_medico, telefone_medico
    FROM T7E4_medicos
    WHERE especialidade_medico = ?
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$especialidade]);

    $row = $stmt->fetch();

    $arr = []; 

    while ($row){
        $arr[] = new InfoDoc($row["nome_medico"] ?? '', $row["telefone_medico"] ?? '');
        $row = $stmt->fetch();
    }

    echo json_encode($arr);

?>