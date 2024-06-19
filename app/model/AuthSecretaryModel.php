<?php
namespace app\model;
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
    public function createUser() {
        $usuario = "123";
        $senha = "$2y$10$7sNNa4YF.GXsadeAxQ6YHuf53Ro.inOfraACG8JDPJx/UoCn5SbPW";
        
        $stmt = $this->pdo->prepare("INSERT INTO secretaria (usuario, senha) VALUES (:usuario, :senha)");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
    }
    
    public function checkUser($usuario, $senha) {
        $stmt = $this->pdo->prepare("SELECT id, senha FROM secretaria WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $id = $result['id'];
            $hashedPassword = $result['senha'];


            if ($hashedPassword && password_verify($senha, $hashedPassword)) {
                return $id; // Senha correta
            } else {
                return null; // Senha incorreta 
            }
        }
    }
}
?>