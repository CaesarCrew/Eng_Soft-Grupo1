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
            if (isset($_POST['secretary_id']) && isset($_POST['selected_schedules'])) {
                $selectedSchedules = $_POST['selected_schedules'] ?? [];
                $id_criador = htmlspecialchars($_POST['secretary_id']);
                $tipo_criador = 'secretaria'; // Exemplo de tipo
                foreach ($selectedSchedules as $id) {
                    if ($this->model->addSchedule($id, $tipo_criador, $id_criador)) {
                        echo "Agendamento Feito com sucesso";
                    } else {
                        echo "Falha ao selecionar o horário com ID $id";
                    }
                }
            } else {
                echo "Nenhum horário foi selecionado";
            }
        }
    }
}
