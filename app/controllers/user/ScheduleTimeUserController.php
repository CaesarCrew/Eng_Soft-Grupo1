<?php

namespace app\controllers\user;

use app\model\ScheduleTimeUserModel;


class ScheduleTimeUserController
{
    private $model;

    public function __construct()
    {
        $this->model = new ScheduleTimeUserModel();
    }

    public function showSchedule()
    {
        $schedules = $this->model->getAvailableSchedules();
        $viewData = [
            "schedules" => $schedules,
            "title" => "Realizar Agendamento",
            "style" => "public/css/user/ScheduleTimeUser.css"
        ];
        return [
            "view" => "user/ScheduleTimeUserView.php",
            "data" => $viewData
        ];
    }

    public function selectTime()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents('php://input'), true);


            if (!empty($data["selected_schedules"]) && !empty($data['user_id'])) {
                $selectedSchedules = $data['selected_schedules'] ?? [];
                $patientId = $data['user_id'] ?? '';

                // Adicionar os agendamentos selecionados
                $messages = [];
                foreach ($selectedSchedules as $id) {
                    if ($this->model->addSchedule($id, 'usuario', $patientId)) {
                        $messages[] = "Agendamento feito com sucesso!";
                    } else {
                        $messages[] = "Falha ao selecionar o horário com ID $id.";
                    }
                }

                http_response_code(200);
                echo json_encode([
                    'status' => 'success',
                    'messages' => $messages
                ]);
            }
        } else {
            http_response_code(405);
            echo json_encode([
                'status' => 'error',
                'message' => 'Método não permitido.'
            ]);
        }
    }
}
