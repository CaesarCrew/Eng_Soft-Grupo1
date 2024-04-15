<?php

namespace app\controllers;

use app\model\SchedulingSecretaryModel;

class SchedulingSecretaryController{
    public function showAddScheduleForm($params){
        return[
            "view" => "secretary/addScheduleView.php",
            "data" => ["title" => "horarios"]
        ];
    }

    public function AddScheduleForm($params){
        $date = $_POST['data'];
        $times = isset($_POST['times']) ? $_POST['times'] : [];
        var_dump($times);
     
        $dayOfTheWeek = null;
        
        $formatoData = 'Y-m-d'; 
        $formatoTime = 'H:i';

        if(!empty($date)){
            $dateTime = \DateTime::createFromFormat($formatoData, $date);
        }else{
            echo "data não enviada";
            return;
        }
        
        if ($dateTime && $dateTime->format($formatoData) === $date) {
            
            $daysOfTheWeek = [
                1 => 'Segunda-feira',
                2 => 'Terça-feira',
                3 => 'Quarta-feira',
                4 => 'Quinta-feira',
                5 => 'Sexta-feira',
                6 => 'Sábado',
                7 => 'Domingo'
            ];
            $dayOfTheWeek = $daysOfTheWeek[$dateTime->format('N')];
        } else {
            echo "A data $date não é válida.";
            return;
        }
        foreach($times as $time){

            $dateTime = \DateTime::createFromFormat($formatoTime, $time);
            if (!$dateTime   ||  $dateTime->format($formatoTime) !== $time) {
                echo "A hora $time não é válida.";
                return;
                
            }
            
            $SchedulingSecretaryModel = new SchedulingSecretaryModel;
            $SchedulingSecretaryModel->add($dayOfTheWeek , $date , $time);
            
            
        }
        $SchedulingSecretaryModel->closeConnection();
       
        return[
            "view" => "secretary/addScheduleView.php",
            "data" => ["title" => "horarios"]
        ];
    }
}