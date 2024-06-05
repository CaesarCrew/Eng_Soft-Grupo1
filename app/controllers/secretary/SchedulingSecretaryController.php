<?php

namespace app\controllers\secretary;

use app\model\SchedulingSecretaryModel;
//  use app\database\SchedulingSecretaryModel;
class SchedulingSecretaryController{

    public function showSchedule(){
        $page = 1;

        if(isset($_GET["pagina"])){
            $page = filter_input(INPUT_GET, "pagina" ,FILTER_VALIDATE_INT);
        }
        if (isset($_GET['edit']) && $_GET['edit'] === 'success') {
            echo "<p>Edição realizada com sucesso!</p>";
        }
        if (isset($_GET['delete']) && $_GET['delete'] === 'success') {
            echo "<p>deletado  com sucesso!</p>";
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
        $SchedulingSecretaryModel->closeConnection();
        return[
            "view" => "secretary/schedulingSecretaryView.php",
            "data" => ["title" => "agenda" ,"dados" => $dados ,"page" => $page , "pages"=>$pages]
        ];
    }

    public function dayOfTheWeek($date){
        $dayOfTheWeek = null;
        
        $formatoData = 'Y-m-d'; 
        

        if(!empty($date)){
            $dateTime = \DateTime::createFromFormat($formatoData, $date);
        }else{
            echo "data não enviada";
            return null;
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
            return null;
        }
        return $dayOfTheWeek;
    }

    public function AddScheduleForm(){
        $date = $_POST['data'];
        $times = isset($_POST['times']) ? $_POST['times'] : [];
        $formatoTime = 'H:i';
        
        
        $dayOfTheWeek = $this->dayOfTheWeek($date);

        if($dayOfTheWeek === null){
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
        
        return  $this->showSchedule();
    }
    
    public function editSchedule($params){
        $id = isset($params["edit_id"]) ? $params["edit_id"] : null;
        if (!$id) {
            echo "ID inválido.";
            return;
        }
        $date = isset($_POST['data']) ? trim($_POST['data']) : null;
        $time = isset($_POST['hora']) ? trim($_POST['hora']) : null;
        $formatoTime = 'H:i';
    
        if (!$date || !$time) {
            echo "Data ou hora não fornecida.";
            return;
        }

        $dayOfTheWeek = $this->dayOfTheWeek($date);
        $SchedulingSecretaryModel = new SchedulingSecretaryModel;
        $SchedulingSecretaryModel->editRecord($id , $dayOfTheWeek, $date , $time);
        $SchedulingSecretaryModel->closeConnection();

        $this->showSchedule();
        header("Location: http://localhost/horarios?edit=success");
        exit();
    }

    public function deleteSchedule($params){
        $id = isset($params["delete_id"]) ? $params["delete_id"] : null;
        if (!$id) {
            echo "ID inválido.";
            return;
        }
        $SchedulingSecretaryModel = new SchedulingSecretaryModel;
        $SchedulingSecretaryModel->deleteRecord($id);
        $SchedulingSecretaryModel->closeConnection();

        $this->showSchedule();
        header("Location: http://localhost/horarios?delete=success");
        exit();
    }
    
}
?>