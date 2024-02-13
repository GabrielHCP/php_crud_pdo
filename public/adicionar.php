<?php
     if (!isset($_SESSION))
     session_start();

     if (!isset($_SESSION['id'])) {
     session_destroy();
     header("Location: index.php");
     die();
    }


    require_once "./app/model/conexao.php";
    $pdo = new Conexao("anydesk_pdo", "localhost", "root", "");

    if (isset($_POST['patrimonio'])) {
        $patrimonio = addslashes($_POST['patrimonio']);
        $nome = addslashes($_POST['nome']);
        $codigo = addslashes($_POST['codigo']);
        $senha = addslashes($_POST['senha']);

        if (!empty($patrimonio) && !empty($nome) && !empty($codigo) && !empty($senha)) {
            $pdo->adicionarUser($patrimonio, $nome, $codigo, $senha);
            header("Location: users.php");
        } else {
            echo "Os campos não podem estar vazios";
        }


    }


?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adicionar usuário</title>
        <link rel="stylesheet" href="assets/styles/style.css">
    </head>
        <body>
            <form class='login-form' method = "POST" action ="">
        <div class="flex-row">
            <input id="username" class='lf--input' placeholder='Patrimônio' type='text' name="patrimonio">
        </div>
        <div class="flex-row">
            <input id="password" class='lf--input' placeholder='Nome' type='text' name="nome">
        </div>
        <div class="flex-row">
            <input id="password" class='lf--input' placeholder='Código Anydesk' type='text' name="codigo">
        </div>
        <div class="flex-row">
            <input id="password" class='lf--input' placeholder='Senha' type='text' name="senha">
        </div>
        <input class='lf--submit' type='submit' value='Salvar'>
        </form>
    </body>
</html>