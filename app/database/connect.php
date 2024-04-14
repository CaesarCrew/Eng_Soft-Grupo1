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
        $this->pdo->exec("USE ".$_ENV['DB_NAME']);
        $this->checkBankAndTable();
       
        return $this->pdo;
        }catch(PDOException $err){
            return  null;
        }
    }
    public function closeConnection()
    {
        $this->pdo = null;
    }
    private function checkBankAndTable(){
        $Database = new Database();
        $Database->checkBankAndTable( $this->pdo , $_ENV['DB_NAME']);
    }

    
}