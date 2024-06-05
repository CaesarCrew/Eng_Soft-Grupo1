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
            "title" => "Agendamentos"
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
                return "Agendamento cancelado com sucesso.";
            } else {
                return "Falha ao cancelar o agendamento.";
            }
        }

        header('Location: /visualizarAgendamentos');
        exit();
    }

    public function infoPatient()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_consulta'])) {
            $id_consulta = htmlspecialchars($_POST['id_consulta']);
            header('Location: /visualizarAgendamentos/informacoes?id_consulta=' . $id_consulta);
            exit();
        }
    }

    public function listInfo()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_consulta'])) {
            $id_consulta = htmlspecialchars($_GET['id_consulta']);
            $patient = $this->model->listInfo($id_consulta);
            if ($patient) {
                return [
                    "view" => "secretary/infoView.php",
                    "data" => [
                        "title" => "Informações do Agendamento",
                        "patient" => $patient
                    ]
                ];
            } else {
                return "Erro ao listar informações do agendamento.";
            }
        }
    }
}
?>
