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
        include 'app/views/secretary/SchedulesSecretaryViewCancel.php';
    }

    public function cancelSchedule()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_consulta'])) {
            $id_consulta = htmlspecialchars($_POST['id_consulta']);
            if ($this->model->cancelSchedule($id_consulta)) {
                echo "Agendamento cancelado com sucesso.<br>";
            } else {
                echo "Falha ao cancelar o agendamento.<br>";
            }
        }

        header('Location: /visualizarAgendamentos');
        exit();
    }
}
?>
