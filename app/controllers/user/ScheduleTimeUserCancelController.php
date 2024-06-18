<?php

namespace app\controllers\user;

use app\model\ScheduleTimeUserCancelModel;

class ScheduleTimeUserCancelController
{
    private $model;
    private $headerFunction;

    public function __construct($headerFunction = 'header')
    {
        $this->model = new ScheduleTimeUserCancelModel();
        $this->headerFunction = $headerFunction;
    }

    public function showAppointments()
    {
        $appointments = $this->model->getUserAppointments($_SESSION['user_id']);
        $viewData = [
            "appointments" => $appointments,
            "title" => "Meus Agendamentos",
            "style" => "/public/css/user/ScheduleTimeUserCancel.css"
        ];
        return [
            "view" => "user/SchedulesUserViewCancel.php",
            "data" => $viewData
        ];
    }

    public function cancelAppointment()
    {
        ($this->headerFunction)('Content-Type: application/json');

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_consulta'])) {
            $id_consulta = htmlspecialchars($_POST['id_consulta']);
            
            if ($this->model->cancelAppointment($id_consulta)) {
                echo json_encode(['message' => 'Consulta cancelada com sucesso']);
            } else {
                ($this->headerFunction)('HTTP/1.1 500 Internal Server Error');
                echo json_encode(['message' => 'Falha ao cancelar a consulta']);
            }
        } else {
            ($this->headerFunction)('HTTP/1.1 400 Bad Request');
            echo json_encode(['message' => 'Requisição inválida']);
        }
    }
}
?>
