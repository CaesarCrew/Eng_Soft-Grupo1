<?php

namespace app\model;
use PDO;
use Connect;
use PDOException;

class AuthUserModel  extends Connect{
    private $pdo;

    public function __construct()
    {  
        
        $this->pdo = $this->getConnection();
        
        if (!$this->pdo){
            throw new  PDOException();
        }
    }
    public function chackOutCpf($cpf) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE cpf =:cpf ");
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        $rows =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($rows)) {
            return true;
        } else {
            return false;
        }
    }
    public function chackOutEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email = :email ");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $rows =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($rows)){
            return true;
        } else {
            return false;
        }
    }
    public function chackOutTelefone($telefone) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE telefone =:telefone ");
        $stmt->bindParam(':telefone', $telefone);
        $stmt->execute();
        $rows =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($rows)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUser($email, $senha) {
        $stmt = $this->pdo->prepare("SELECT id, senha FROM usuario WHERE email = :email");
        $stmt->bindParam(':email', $email);
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

    public function signUp($Nome, $senha, $email, $telefone, $cpf, $genero, $data_de_nascimento ,  $cep ,$logradouro ,$numero ,$complemento ,$bairro , $cidade , $estado){
        
        try {
        $stmt = $this->pdo->prepare("INSERT INTO usuario (Nome, senha, email, telefone, cpf, genero, data_de_nascimento) VALUES (:Nome, :senha, :email, :telefone, :cpf, :genero, :data_de_nascimento)");
        $stmt->bindParam(':Nome', $Nome);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':data_de_nascimento', $data_de_nascimento);
        $stmt->execute();

        $id = $this->pdo->lastInsertId();

        $this->insertAddress (  $id , $cep ,$logradouro ,$numero ,$complemento ,$bairro , $cidade , $estado);
        
        } catch (PDOException $e) {
            
            echo "Erro ao salvar  dados: " . $e->getMessage();
        }
    }
    
    public function insertAddress (  $id , $cep ,$logradouro ,$numero ,$complemento ,$bairro , $cidade , $estado){
        try {
            $stmt = $this->pdo->prepare("INSERT INTO endereco (id_usuario, cep, logradouro, numero, complemento, bairro, cidade, estado) VALUES (:id, :cep, :logradouro, :numero, :complemento, :bairro, :cidade, :estado)");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':cep', $cep);
            $stmt->bindParam(':logradouro', $logradouro);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':complemento', $complemento);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':estado', $estado);
    
            $stmt->execute();
    
            
            return;
        } catch (PDOException $e) {
            echo "Erro ao cadastrar endereço: " . $e->getMessage();
        }
    }

    public function isEmailExists($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    public function storeResetToken($email, $token, $expires) {
        $stmt = $this->pdo->prepare("UPDATE usuario SET reset_token = ?, reset_expires = ? WHERE email = ?");
        $stmt->execute([$token, $expires, $email]);
    }

    public function isValidToken($token) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE reset_token = ? AND reset_expires > NOW()");
        $stmt->execute([$token]);
        return $stmt->rowCount() > 0;
    }

    public function updatePassword($token, $newPasswordHash) {
        $stmt = $this->pdo->prepare("UPDATE usuario SET senha = ?, reset_token = NULL, reset_expires = NULL WHERE reset_token = ?");
        $stmt->execute([$newPasswordHash, $token]);
    }

}


?>