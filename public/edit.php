<?php 
     if (!isset($_SESSION))
     session_start();

    if (!isset($_SESSION['id'])) {
     session_destroy();
     header("Location: index.php");
     die();
    }



      require_once ("./app/model/conexao.php"); 
      $pdo = new Conexao("anydesk_pdo", "localhost", "root", "");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar usuário</title>
        <link rel="stylesheet" href="assets/styles/style.css">
    </head>
    <?php 
        if (isset($_GET['id'])) {
            $id_up = addslashes($_GET['id']);
            $dados = $pdo->buscarId($id_up);

            if (isset($_POST['atualizar']) && !empty($_POST['atualizar'])) {
                $pdo->atualizarDado($id_up, $_POST['patrimonio'], $_POST['nome'], $_POST['senha']);
                header("Location: users.php");
            } 

        }
      

    ?>
        <body>
            <?php   ?>
            
            <form class='login-form' method = "POST" action ="">
        <div class="flex-row">
            <input name = "patrimonio" id="username" class='lf--input' placeholder='Patrimônio' type='text' value = <?php echo $dados['patrimonio']; ?>>
        </div>
        <div class="flex-row">
            <input name = "nome" id="password" class='lf--input' placeholder='Nome' type='text' value = <?php echo $dados['nome_usuario']; ?> >
        </div>
        <div class="flex-row">
            <input name = "codigo" id="password" class='lf--input' placeholder='Código AnyDesk' type='text' value = <?php echo $dados['codigo']; ?>>
        </div>
        <div class="flex-row">
            <input name = "senha" id="password" class='lf--input' placeholder='Senha' type='text' value = <?php echo $dados['senha']; ?>>
        </div>
        <input class='lf--submit' type='submit' value='Salvar' name="atualizar">
        </form>
    </body>
</html>

