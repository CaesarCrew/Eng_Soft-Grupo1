<?php

namespace app\database;

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
        if (empty($rows)) {
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
        
        echo "Dados salvos nas duas tabelas com sucesso!";
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
    
            echo "Endereço cadastrado com sucesso!";
            return;
        } catch (PDOException $e) {
            echo "Erro ao cadastrar endereço: " . $e->getMessage();
        }
    }

}


?>