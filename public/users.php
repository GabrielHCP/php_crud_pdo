<?php 
    if (!isset($_SESSION))
        session_start();

    if (!isset($_SESSION['id'])) {
        session_destroy();
        header("Location: index.php");
        die();
    }

    require_once("./app/model/conexao.php");
    $pdo = new Conexao("anydesk_pdo", "localhost", "root", "");
    $dados = $pdo->mostrarDados();
   

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Área de dados</title>
        <link rel="stylesheet" href="assets/styles/users.css">
        <style>
            #adicionar {
                padding: 5px;
                background: white;
                color: black;
                border-radius: 5px;
                font-weight: 100;
                cursor: pointer;
            }

        </style>
    </head>
    <body>
    <a href="adicionar.php" id="adicionar">Adicionar</a>
    <h2>AnyDesk</h2>
<div class="table-wrapper">
    <table class="fl-table">
        <thead>
        <tr>
            <th>Patrimônio</th>
            <th>Nome</th>
            <th>Código</th>
            <th>Senha</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php   
            for($i=0; $i < count($dados); $i++) {
                echo "<tr>";
                foreach($dados[$i] as $k => $v) {
                    if($k != 'id') {
                        echo "<td>". $v . "</td>";
                    }
                }
                ?><td><a href="edit.php?id=<?php echo $dados[$i]['id']; ?>">Editar</a><a href="users.php?id_del=<?php echo $dados[$i]['id']; ?>">Excluir</a></td> <?php
                echo "</tr>";
            }
        ?>
        <tbody>
    </table>
</div>
    </body>
</html>

<?php 
    if (isset($_GET['id_del'])) {
        $id_delete = $_GET['id_del'];
        $pdo->deletarId($id_delete);
        header("Location: users.php");
    }


?>