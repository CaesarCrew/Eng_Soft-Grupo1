<?php

namespace app\controllers\secretary;

use app\model\ScheduleTimeSecretaryCancelModel;

class ScheduleTimeSecretaryCancelController
{
    private $model;

    public function __construct()
    {
        $this->model = new ScheduleTimeSecretaryCancelModel();
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function showAppointments()
    {
        $appointments = $this->model->getAppointments();
        $viewData = [
            "appointments" => $appointments,
            "title" => "Agendamentos",
            'style' => 'public/css/secretary/ScheduleTimeSecretaryCancel.css'
        ];
        return [
            "view" => "secretary/SchedulesSecretaryViewCancel.php",
            "data" => $viewData
        ];
    }

    public function cancelSchedule()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_consulta'])) {
            $id_consulta = htmlspecialchars($_POST['id_consulta']);
            if ($this->model->cancelSchedule($id_consulta)) {
                return [
                    'status' => 'success',
                    'message' => 'Agendamento cancelado com sucesso.'
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Falha ao cancelar o agendamento.'
                ];
            }
        }

        return [
            'status' => 'error',
            'message' => 'Método inválido.'
        ];
    }

    public function listInfo()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_consulta'])) {
            $id_consulta = htmlspecialchars($_GET['id_consulta']);
            $patient = $this->model->listInfomation($id_consulta);
            $status = $this->model->getStatus($id_consulta); // Obter o status da consulta
            
            if ($patient !== null) {
                unset($patient['senha']);
                return [
                    "view" => "secretary/infoView.php",
                    "data" => ["patient" => $patient, "status" => $status, "title" => "Informações do Paciente", 'style' => '/public/css/secretary/info.css']
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Erro ao listar informações do agendamento."
                ];
            }
        }
    
        return [
            'status' => 'error',
            'message' => 'Método inválido.'
        ];
    }

    public function updateStatus()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = json_decode(file_get_contents("php://input"), true);
            
            if (isset($input['id_consulta']) && isset($input['status'])) {
                $id_consulta = htmlspecialchars($input['id_consulta']);
                $status = htmlspecialchars($input['status']);
    
                if ($this->model->updateStatus($id_consulta, $status)) {
                    $patient = $this->model->listInfomation($id_consulta);
                    if ($patient !== null) {
                        unset($patient['senha']);
                        http_response_code(200);
                        header('Content-Type: application/json');
                        echo json_encode([
                            'patient' => $patient,
                            'status' => 'success',
                            'message' => 'Status da consulta atualizado com sucesso.'
                        ]);
                        exit;
                    } else {
                        http_response_code(500);
                        header('Content-Type: application/json');
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Erro ao listar informações do agendamento.'
                        ]);
                        exit;
                    }
                } else {
                    http_response_code(500);
                    header('Content-Type: application/json');
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Falha ao atualizar o status da consulta.'
                    ]);
                    exit;
                }
            }
        }
    
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => 'Método inválido para atualização de status.'
        ]);
        exit;
    }
}
?>
