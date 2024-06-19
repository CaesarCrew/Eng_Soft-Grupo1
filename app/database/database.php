<?php

class Database {
    

    public function checkBankAndTable($pdo , $dbname){

        if($_ENV['AMBIENTE'] === "TEST"){
            $dbname = $_ENV['DB_NAME_TEST'];
        }else{
            $dbname = $_ENV['DB_NAME'];
        }
        
        $stmt = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'");
        $databaseExists = $stmt->rowCount() > 0;
        
        if (!$databaseExists) {
            
            $pdo->exec("CREATE DATABASE $dbname");
            // echo "Banco de dados '$dbname' criado com sucesso!<br>";
        }else{
            return;
        }
        
        $pdo->exec("USE $dbname");
        
        $tables = require 'tables.php';
        
        foreach ($tables as $table) {
            
            $stmt = $pdo->query("SHOW TABLES LIKE '$table[name]'");
            $tableExists = $stmt->rowCount() > 0;
            
            if (!$tableExists) {
                
                $pdo->exec($table['create']);
                // echo "Tabela '{$table['name']}' criada com sucesso!<br>";
            }
        }
    }
    
}