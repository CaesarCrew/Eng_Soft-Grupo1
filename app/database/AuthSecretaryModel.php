<?php
namespace app\database;
use PDO;
use Connect;
use PDOException;

class AuthSecretaryModel extends Connect{
    private $pdo;

    public function __construct() {  
        $this->pdo = $this->getConnection();
        
        if (!$this->pdo) {
            throw new  PDOException();
        }
    }

    public function checkUser($usuario, $senha) {
        $stmt = $this->pdo->prepare("SELECT senha FROM secretaria WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        $hashedPassword = $stmt->fetchColumn();

        
        if ($hashedPassword && password_verify($senha, $hashedPassword)) {
            return true; // Senha correta
        } else {
            return false; // Senha incorreta 
        }
    }
}

?>