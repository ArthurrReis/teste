<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../_css/estilo.css"/>
    <meta charset="UTF-8"/>
    <title>Sistema CRUD - Criar</title>
</head>
<body>
<div>
    <?php 
        /* ALTERAR: Nome do arquivo TXT e nome deste arquivo PHP */
        $arquivo_db = "alunos.txt";
        $pagina_atual = "criarAluno.php";
        $msg = "";

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            /* ALTERAR: Captura de dados do formulário */
            $campo1 = $_POST["matricula"];
            $campo2 = $_POST["nome"];
            $campo3 = $_POST["email"];

            if(!file_exists($arquivo_db)){
                $ponteiro = fopen($arquivo_db, "w");
                /* ALTERAR: Cabeçalho do arquivo (se necessário) */
                $header = "Matricula;Nome;Email\n";
                fwrite($ponteiro, $header);
                fclose($ponteiro);
            }

            $ponteiro = fopen($arquivo_db, "a");
            /* ALTERAR: Formatação da linha que será salva */
            $linha = "{$campo1};{$campo2};{$campo3}\n";
            
            fwrite($ponteiro, $linha);
            fclose($ponteiro);
            $msg = "Registro criado com sucesso!";
        }
    ?>

    <h1>Criar Novo Registro</h1>

    <form action="<?php echo $pagina_atual; ?>" method="POST">
        Matrícula: <input type="number" name="matricula" required>
        <br><br>    
        Nome: <input type="text" name="nome" required>
        <br><br>
        Email: <input type="email" name="email" required>
        <br><br>
        <input type="submit" value="Incluir Novo Registro">
    </form>

    <br>
    <button><a href="lerAluno.php">Ver Todos</a></button>
    <button><a href="buscarAluno.php">Buscar</a></button>
    
    <p><?php echo $msg; ?></p>
</div>
</body>
</html>
