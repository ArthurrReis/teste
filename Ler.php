<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../_css/estilo.css"/>
    <meta charset="UTF-8"/>
    <title>Sistema CRUD - Listar</title>
</head>
<body>
<div>
    <h1>Lista de Registros</h1>
    <?php
        /* ALTERAR: Nome do arquivo TXT */
        $arquivo_db = "alunos.txt";

        if (file_exists($arquivo_db)) {
            $ponteiro = fopen($arquivo_db, "r") or die("Não foi possível abrir o arquivo.");

            /* Opcional: fgets($ponteiro); -> Use se quiser pular a primeira linha (cabeçalho) */

            while (!feof($ponteiro)) {
                $linha = fgets($ponteiro);
                
                if (trim($linha) == "") continue;

                /* ALTERAR: Formatação da exibição (pode ser dentro de uma <table> ou <li>) */
                echo htmlspecialchars($linha) . "<br>";
            }

            fclose($ponteiro);
        } else {
            echo "Nenhum registro encontrado.";
        }
    ?>
    <br>
    <button><a href="criarAluno.php">Voltar ao Início</a></button>
</div>
</body>
</html>

