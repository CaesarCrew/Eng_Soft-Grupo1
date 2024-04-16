<?php

namespace app\controllers;

use app\model\SchedulingSecretaryModel;

class SchedulingSecretaryController{
    public function showAddScheduleForm($params){
        return[
            "view" => "secretary/SchedulingSecretaryView.php",
            "data" => ["title" => "agenda"]
        ];
    }

    public function AddScheduleForm($params){
        $date = $_POST['data'];
        $times = isset($_POST['times']) ? $_POST['times'] : [];

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
        $SchedulingSecretaryModel = new SchedulingSecretaryModel;
        foreach($times as $time){
            $dateTime = \DateTime::createFromFormat($formatoTime, $time);
            if (!$dateTime   ||  $dateTime->format($formatoTime) !== $time) {
                echo "A hora $time não é válida.";
                return;
            }
            $SchedulingSecretaryModel->add($dayOfTheWeek , $date , $time);
        }

        $SchedulingSecretaryModel->closeConnection();
        
        return  $this->showTimetables();
    }
    public function showTimetables(){
        $page = 1;

        if(isset($_GET["pagina"])){
            $page = filter_input(INPUT_GET, "pagina" ,FILTER_VALIDATE_INT);
        }

        if (!$page) {
            $page = 1;
        }

        $limite = 4;
        $inicio = ($page * $limite) - $limite;
        
        $SchedulingSecretaryModel = new SchedulingSecretaryModel;
        $dados = $SchedulingSecretaryModel->getTimeTables($inicio , $limite);
        
        $amount = $SchedulingSecretaryModel->numberOfLines();
        $pages = ceil((int)$amount[0]["count"]/ $limite); ;
       
        return[
            "view" => "secretary/SchedulingSecretaryView.php",
            "data" => ["title" => "agenda" ,"dados" => $dados ,"page" => $page , "pages"=>$pages]
        ];
    }
    
}