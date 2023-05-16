<?php

class Usuario
{
    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
        } catch (PDOException $e) {
            $this->msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $senha)
    {
        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            return false;
        } else {
            $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, senha) VALUES (:n, :t)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":t", $senha);
            $sql->execute();
            return true;
        }
    }
}
