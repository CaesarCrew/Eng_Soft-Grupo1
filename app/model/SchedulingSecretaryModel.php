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
                $lastInsertId = $this->pdo->lastInsertId();
                return ["status" => "success", "mensagem" => "Horário cadastrado com sucesso", "id" => $lastInsertId];
            } catch (PDOException $e) {
                return ["status" => "error","mensagem" => $e->getMessage()];
            }
        }else{
            return ["status" => "error","mensagem" => "horario ja cadastrado."];
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
        $stmt = $this->pdo->prepare("SELECT id, dia_da_semana, DATE_FORMAT(STR_TO_DATE(data, '%Y-%m-%d'), '%d-%m-%Y') AS data, hora
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
    public function deleteRecord ($id){
        $stmtBefore = $this->pdo->prepare("SELECT COUNT(*) FROM horario_disponivel WHERE id = :id");
        $stmtBefore->bindParam(':id', $id);
        $stmtBefore->execute();
        $countBefore = $stmtBefore->fetchColumn();

        
        $stmt = $this->pdo->prepare("DELETE FROM horario_disponivel WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        
        $stmtAfter = $this->pdo->prepare("SELECT COUNT(*) FROM horario_disponivel WHERE id = :id");
        $stmtAfter->bindParam(':id', $id);
        $stmtAfter->execute();
        $countAfter = $stmtAfter->fetchColumn();

        
        $wasDeleted = $countBefore > $countAfter;

        return $wasDeleted;
    }
    public function putRecord($id ,$dia_da_semana,$date , $time){
       
        $stmt = $this->pdo->prepare("SELECT dia_da_semana, `data`, hora FROM horario_disponivel WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $existingData = $stmt->fetch(PDO::FETCH_ASSOC);
       
        if (is_array($existingData) && ($existingData['data'] != $date || date('H:i', strtotime($existingData['hora'])) != $time)) {
            
            $updateStmt = $this->pdo->prepare("UPDATE horario_disponivel SET dia_da_semana = :dia_da_semana, `data` = :data, hora = :hora WHERE id = :id");
            $updateStmt->bindParam(':id', $id);
            $updateStmt->bindParam(':dia_da_semana', $dia_da_semana);
            $updateStmt->bindParam(':data', $date);
            $updateStmt->bindParam(':hora', $time);
            $success = $updateStmt->execute();
            $success = $updateStmt->rowCount() > 0;
            return $success;
        } else {
           
            return false;
        }
    }
}
