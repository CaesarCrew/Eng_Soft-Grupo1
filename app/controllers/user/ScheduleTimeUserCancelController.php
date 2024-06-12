<?php

namespace app\controllers\user;

use app\model\ScheduleTimeUserCancelModel;

class ScheduleTimeUserCancelController
{
    private $model;

    public function __construct()
    {
        $this->model = new ScheduleTimeUserCancelModel();
    }

    public function showAppointments()
    {
        $appointments = $this->model->getUserAppointments($_SESSION['user_id']);
        $viewData = [
            "appointments" => $appointments,
            "title" => "Meus Agendamentos"
        ];
        return [
            "view" => "user/SchedulesUserViewCancel.php",
            "data" => $viewData
        ];
    }

    public function cancelAppointment()
    {
        header('Content-Type: application/json');
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_consulta'])) {
            $id_consulta = htmlspecialchars($_POST['id_consulta']);
            if ($this->model->cancelAppointment($id_consulta)) {
                echo json_encode(['message' => 'Consulta cancelada com sucesso']);
            } else {
                echo json_encode(['message' => 'Falha ao cancelar a consulta']);
            }
        } else {
            echo json_encode(['message' => 'Requisição inválida']);
        }
    }
}
?>
