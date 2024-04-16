<?php

namespace app\model;
use PDO;
use Connect;
use PDOException;

class SchedulingSecretaryModel extends Connect{
    private $pdo;

    public function __construct()
    {  
        
        $this->pdo = $this->getConnection();
        
        if (!$this->pdo){
            throw new  PDOException();
        }
    }
    public function add( $dayOfTheWeek , $date , $time){
        $check = $this->checkIfThereIsTimeAndDate($date , $time);
        if($check === true){
            
            $stmt = $this->pdo->prepare("INSERT INTO horario_disponivel (dia_da_semana, data, hora , disponivel ) VALUES (:dayOfTheWeek, :date , :time , 1)");
            $stmt->bindParam(':dayOfTheWeek', $dayOfTheWeek);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            try {
                $stmt->execute();
                echo "Inserção bem-sucedida!";
            } catch (PDOException $e) {
                echo "Erro ao inserir dados: " . $e->getMessage();
            }
        }else{
            echo "Hora {$time} já cadastrado!";
        }
    }
    public function checkIfThereIsTimeAndDate($date , $time){
        $stmt = $this->pdo->prepare("SELECT * FROM horario_disponivel WHERE data = :date AND hora = :time");
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time', $time);
        $stmt->execute();
        $rows =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($rows)) {
            return true;
        } else {
            return false;
        }
        
    }
    public function getTimeTables  ($inicio , $limite){
        $stmt = $this->pdo->prepare("SELECT dia_da_semana, DATE_FORMAT(STR_TO_DATE(data, '%Y-%m-%d'), '%d-%m-%Y') AS data, hora
        FROM horario_disponivel
        ORDER BY data DESC
        LIMIT $inicio, $limite; ");
        $stmt->execute();
        $rows =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    public function numberOfLines (){
        $stmt = $this->pdo->prepare("SELECT COUNT(data) count FROM horario_disponivel");
        $stmt->execute();
        $amount =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $amount;
    }
}
