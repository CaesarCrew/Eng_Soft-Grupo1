<?php

namespace app\controllers\secretary;

use app\model\ScheduleTimeSecretaryModel;

class ScheduleTimeSecretaryController
{
    private $model;

    public function __construct()
    {
        $this->model = new ScheduleTimeSecretaryModel();
    }

    public function showSchedule()
    {
        $schedules = $this->model->getAvailableSchedules();
        include 'app/views/secretary/ScheduleTimeSecretaryView.php';
    }

    public function selectTime()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $secretary_id = htmlspecialchars($_POST['secretary_id']);

            // Lidar com os horários selecionados para agendamento
            $selectedSchedules = $_POST['selected_schedules'] ?? [];
            foreach ($selectedSchedules as $id) {
                if ($this->model->addSchedule($id, 'secretaria', $secretary_id)) {
                    echo "Agendamento feito com sucesso para o horário ID $id.<br>";
                } else {
                    echo "Falha ao selecionar o horário com ID $id.<br>";
                }
            }

            // Lidar com os horários selecionados para cancelamento
            $canceledSchedules = $_POST['canceled_schedules'] ?? [];
            foreach ($canceledSchedules as $id) {
                if ($this->model->cancelSchedule($id)) {
                    echo "Agendamento cancelado com sucesso para o horário ID $id.<br>";
                } else {
                    echo "Falha ao cancelar o horário com ID $id.<br>";
                }
            }
        }

        header('Location: /horarios');
        exit();
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
