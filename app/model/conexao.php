<?php

class Conexao {
    private $pdo;

    public function __construct($dbname, $host, $user, $pass) {
        try { 
            $this->pdo = new PDO("mysql:dbname=" .$dbname. ";host=" .$host, $user, $pass);
        }
        catch(PDOException $e) {
            echo "Erro com o banco de dados" . $e->getMessage();
        }
        catch(Exception $e) {
            echo "Erro genérico" . $e->getMessage();
        }
    }

    public function mostrarDados() {
        $res = array();
        $res = $this->pdo->prepare("SELECT * FROM cadastros");
        $res->execute();
        $cmd = $res->fetchAll(PDO::FETCH_ASSOC);
        return $cmd;
    }
    public function buscarId($id) {
        $res = array();
        $res = $this->pdo->prepare("SELECT * FROM cadastros WHERE id = :id LIMIT 1");
        $res->bindValue(':id', $id);
        $res->execute();
        $cmd = $res->fetch(PDO::FETCH_ASSOC);
        return $cmd;
    }

    public function atualizarDado($id, $patrimonio, $nome, $senha) {
        $res = $this->pdo->prepare("UPDATE cadastros SET patrimonio = :patri, nome_usuario = :nome, senha = :senha 
        WHERE id = :id");
        $res->bindValue(':patri', $patrimonio);
        $res->bindValue(':nome', $nome);
        $res->bindValue(':senha', $senha);
        $res->bindValue(':id', $id);
        $res->execute();
        return true;
    }

    public function deletarId($id) {
        $res = $this->pdo->prepare("DELETE FROM cadastros WHERE id = :id");
        $res->bindValue(':id', $id);
        $res->execute();
    }

    public function adicionarUser($patrimonio, $nome, $codigo, $senha) {
        $res = $this->pdo->prepare("INSERT INTO cadastros (patrimonio, nome_usuario, codigo, senha) VALUES (:patri, :nome, :codigo, :senha)");
        $res->bindValue(':patri', $patrimonio);
        $res->bindValue(':nome', $nome);
        $res->bindValue(':codigo', $codigo);
        $res->bindValue(':senha', $senha);
        $res->execute();
    }
 
    public function buscarUsuario($nome) {
       $res = array();
       $res = $this->pdo->query("SELECT * FROM usuarios WHERE nome = '$nome'");
       $cmd = $res->fetch(PDO::FETCH_ASSOC);
       return $cmd;
    }


}
