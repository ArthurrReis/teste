<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../_css/estilo.css"/>
    <meta charset="UTF-8"/>
    <title>Sistema CRUD - Buscar</title>
</head>
<body>
<div>
    <?php
    /* ALTERAR: Nome do arquivo TXT */
    $arquivo_db = "alunos.txt";
    $msg = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        /* ALTERAR: Campo de busca vindo do formulário */
        $id_busca = $_POST["matricula"];
        
        $ponteiro = fopen($arquivo_db, "r") or die("Arquivo não encontrado");
        
        /* Opcional: fgets($ponteiro); -> Use se o seu TXT tiver cabeçalho na primeira linha */
        
        while(!feof($ponteiro)){
            $linha = fgets($ponteiro);
            if(trim($linha) == "") continue;

            $colunas = explode(";", $linha);
            $msg = "Registro não encontrado";

            /* ALTERAR: Índice da coluna para comparação (0 é a primeira coluna) */
            if(trim($colunas[0]) == $id_busca){
                /* ALTERAR: Como o resultado será exibido para o usuário */
                echo "<strong>Dados encontrados:</strong> " . $linha;
                $msg = "Busca concluída.";
                break;
            }
        }
        fclose($ponteiro);
    }
    ?>

    /* ALTERAR: Nome do arquivo no action */
    <form action="buscarAluno.php" method="post">
        <h5>Procurar Registro</h5>
        
        <label for="id_campo">Matrícula:</label>
        <input type="number" name="matricula" id="id_campo" required>
        
        <input type="submit" value="Procurar">
        <br>
        <?php echo $msg; ?> 
    </form>
</div>
</body>
</html>
