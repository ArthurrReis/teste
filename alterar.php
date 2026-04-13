<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../_css/estilo.css"/>
    <meta charset="UTF-8"/>
    <title>Sistema CRUD</title>
</head>
<body>
<div>
    <?php
        /* ALTERAR: Nome do arquivo TXT e nome deste arquivo PHP */
        $arquivo_db = "alunos.txt"; 
        $pagina_atual = "alterarAluno.php"; 
        
        $msg = "";
        /* ALTERAR: Chaves do array conforme os campos da sua entidade */
        $campos = ["matricula" => "", "nome" => "", "email" => ""]; 

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["btn_alterar"])){
            
            /* ALTERAR: Variáveis que recebem os dados do formulário */
            $id_busca = $_POST["matricula"];
            $novo_nome = $_POST["nome"];
            $novo_email = $_POST["email"];
            
            $msg = "Registro não encontrado.";
            $ponteiro = fopen($arquivo_db, "r") or die("Erro ao abrir arquivo");
            $conteudo_novo = "";

            while(!feof($ponteiro)){
                $linha = fgets($ponteiro);
                if(trim($linha) == "") continue;

                $colunas = explode(";", $linha);
                
                if(trim($colunas[0]) == $id_busca){
                    /* ALTERAR: A estrutura da linha (ordem das colunas) */
                    $linha = "{$id_busca};{$novo_nome};{$novo_email}\n";
                    $msg = "Alterado com sucesso!";
                }
                $conteudo_novo .= $linha;
            }
            fclose($ponteiro);
            file_put_contents($arquivo_db, $conteudo_novo);
            
            echo "<h3>Lista Atualizada:</h3>";
            echo nl2br(file_get_contents($arquivo_db));
        }

        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["btnprocurar"])){
            $id_procurado = $_POST["matricula"];
            $ponteiro = fopen($arquivo_db, "r");
            
            while(!feof($ponteiro)){
                $linha = fgets($ponteiro);
                $colunas = explode(";", $linha);
                
                if(trim($colunas[0]) == $id_procurado){
                    /* ALTERAR: Mapeamento das colunas [0, 1, 2...] para as chaves do array */
                    $campos['matricula'] = trim($colunas[0]);
                    $campos['nome']      = trim($colunas[1]);
                    $campos['email']     = trim($colunas[2]);
                    break;
                }
            }
            fclose($ponteiro);
        }
    ?>

    <form action="<?php echo $pagina_atual; ?>" method="post">
        <h5>Procurar Registro</h5>
        <label>Matrícula:</label>
        <input type="number" name="matricula" required>
        <input type="submit" value="Procurar" name="btnprocurar">
    </form>

    <hr>

    <form action="<?php echo $pagina_atual; ?>" method="post">
        <h5>Editar Dados</h5>
        
        ID: <input type="text" name="matricula" value="<?php echo $campos['matricula']; ?>" readonly>
        <br><br>
        Nome: <input type="text" name="nome" value="<?php echo $campos['nome']; ?>" required>
        <br><br>
        Email: <input type="email" name="email" value="<?php echo $campos['email']; ?>" required>
        <br><br>
        
        <input type="submit" value="Salvar Alterações" name="btn_alterar">
        <p><strong>Status:</strong> <?php echo $msg; ?></p>
    </form>
</div>
</body>
</html>
