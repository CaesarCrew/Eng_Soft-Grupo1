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
            if ($patient !== null) {
                unset($patient['senha']);
                return [
                    "view" => "secretary/infoView.php",
                    "data" => ["patient" => $patient, "title" => "Informações do Paciente", 'style' => 'public/css/secretary/info.css']
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
}
