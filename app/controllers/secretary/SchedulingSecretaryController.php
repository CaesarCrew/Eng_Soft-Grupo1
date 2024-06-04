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

    public function AddScheduleForm() {
        $data = json_decode(file_get_contents('php://input'), true);
        $date = isset($data['data']) ? $data['data'] : null;
        $times = isset($data['times']) ? $data['times'] : [];
        $formatoTime = 'H:i';
    
        if (!$date || empty($times)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Data ou horarios nao fornecidos.']);
            return;
        }
    
        $dayOfTheWeek = $this->dayOfTheWeek($date);
    
        if ($dayOfTheWeek === null) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Data invalida.']);
            return;
        }
    
        $SchedulingSecretaryModel = new SchedulingSecretaryModel;
        foreach ($times as $time) {
            $dateTime = \DateTime::createFromFormat($formatoTime, $time);
            if (!$dateTime || $dateTime->format($formatoTime) !== $time) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => "A hora $time não é válida."]);
                return;
            }
            $response = $SchedulingSecretaryModel->add($dayOfTheWeek, $date, $time);
            if($response["status"] === "error"){
                http_response_code(400);
                echo json_encode($response);
                return;
            }
           
        }
    
        $SchedulingSecretaryModel->closeConnection();
    
        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Horarios adicionados com sucesso.']);
    }
    
    public function deleteSchedule($params){
        
        $id = isset($params["delete_id"]) ? $params["delete_id"] : null;
        if (!$id) {
            http_response_code(400); 
            echo json_encode(['status' => 'error', 'message' => 'ID inválido.']);
            return;
        }
        $SchedulingSecretaryModel = new SchedulingSecretaryModel;
        $success = $SchedulingSecretaryModel->deleteRecord($id);
        $SchedulingSecretaryModel->closeConnection();
    
        if ($success) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Horario deletado com sucesso.']);
        } else {
            http_response_code(500); 
            echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar o horario.']);
        }
    }
    

    public function putSchedule($params) {
    
        $data = json_decode(file_get_contents('php://input'), true);
        $id = isset($params["put_id"]) ? $params["put_id"] : null;
        $date = isset($data['data']) ? $data['data'] : null;
        $time = isset($data['time']) ? $data['time'] : null;
        $formatoTime = 'H:i';
        
        if (!$date || !$time) {
            http_response_code(400); 
            echo json_encode(['status' => 'error', 'message' => 'Dados invalidos.']);
            return;
        }
    
        $dateTime = \DateTime::createFromFormat($formatoTime, $time);
        if (!$dateTime || $dateTime->format($formatoTime) !== $time) {
            http_response_code(400); 
            echo json_encode(['status' => 'error', 'message' => "A hora $time não é válida."]);
            return;
        }
    
        if (!$id) {
            http_response_code(400); 
            echo json_encode(['status' => 'error', 'message' => 'ID inválido.']);
            return;
        }
    
        $dayOfTheWeek = $this->dayOfTheWeek($date);
    
        $SchedulingSecretaryModel = new SchedulingSecretaryModel;
        $success = $SchedulingSecretaryModel->putRecord($id, $dayOfTheWeek, $date, $time);
        $SchedulingSecretaryModel->closeConnection();
    
        if ($success) {
            echo json_encode(['status' => 'success', 'message' => 'Horario atualizado com sucesso.']);
        } else {
            http_response_code(500); 
            echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar o horario.']);
        }
    }
    
    
}
?>