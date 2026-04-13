<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../_css/estilo.css"/>
    <meta charset="UTF-8"/>
    <title>Sistema CRUD - Deletar</title>
</head>
<body>
<div>
    <?php
        /* ALTERAR: Nome do arquivo TXT e nome deste arquivo PHP */
        $arquivo_db = "alunos.txt";
        $pagina_atual = "deletarAluno.php";
        $msg = "";

        if($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["btn_deletar"])){
            /* ALTERAR: Campo identificador (ID/Matrícula) vindo do form */
            $id_busca = $_POST["matricula"];
            
            $ponteiro = fopen($arquivo_db, "r");
            $conteudo_novo = "";
            $achou = false;

            while(!feof($ponteiro)){
                $linha = fgets($ponteiro);
                if(trim($linha) == "") continue;

                $colunas = explode(";", $linha);

                /* ALTERAR: Índice da coluna para comparação (0 é a primeira) */
                if(trim($colunas[0]) == $id_busca){
                    $achou = true;
                    continue; // Pula esta linha para não incluí-la no novo conteúdo
                }
                $conteudo_novo .= $linha;
            }
            fclose($ponteiro);

            file_put_contents($arquivo_db, $conteudo_novo);
            $msg = $achou ? "Registro deletado com sucesso!" : "Registro não encontrado.";

            // Lista o conteúdo atualizado
            echo "<h3>Lista Atualizada:</h3>";
            echo nl2br(file_get_contents($arquivo_db));
        }
    ?>

    <form action="<?php echo $pagina_atual; ?>" method="post">
        <h5>Deletar Registro</h5>
        
        <label for="id_campo">Matrícula:</label>
        <input type="number" name="matricula" id="id_campo" required>
        
        <input type="submit" value="Deletar" name="btn_deletar">
        <br>
        <p><strong>Status:</strong> <?php echo $msg; ?></p>
    </form> 
</div>
</body>
</html>
