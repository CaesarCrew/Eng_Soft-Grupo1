<?php
require_once 'Database.php';

class Connect
{
    private $pdo;

    public function getConnection()
    {   
        try{
            
            $this->pdo = new  PDO("mysql:host=".$_ENV['DB_HOST']
            ,$_ENV['DB_USERNAME']
            ,$_ENV['DB_PASSWORD']
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($_ENV['AMBIENTE'] === "TEST"){
            $this->pdo->exec("USE ".$_ENV['DB_NAME_TEST']);
        }else{
            $this->pdo->exec("USE ".$_ENV['DB_NAME']);
        }
        
       
        return $this->pdo;
        }catch(PDOException $err){
            $this->checkBankAndTable();
            return  null;
        }
    }
    public function closeConnection()
    {
        $this->pdo = null;
    }
    private function checkBankAndTable(){
        $Database = new Database();
        if($_ENV['AMBIENTE'] === "TEST"){
            $Database->checkBankAndTable( $this->pdo , $_ENV['DB_NAME_TEST']);
        }else{
            $Database->checkBankAndTable( $this->pdo , $_ENV['DB_NAME']);
        }
        
    }

    
}