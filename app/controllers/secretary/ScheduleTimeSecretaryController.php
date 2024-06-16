<?php

namespace app\controllers\secretary;

use app\model\ScheduleTimeSecretaryModel;
use app\validators\AuthValidator;

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
        $viewData = [
            "schedules" => $schedules,
            "title" => "Realizar Agendamento",
            "style" => "public/css/secretary/ScheduleTimeSecretary.css"
        ];
        return [
            "view" => "secretary/ScheduleTimeSecretaryView.php",
            "data" => $viewData
        ];
    }

    public function selectTime()
    {
        $validateDataUser = new AuthValidator;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents('php://input'), true);
            
            $selectedSchedules = $data['selected_schedules'] ?? [];
            $secretaryId = $data['secretary_id'] ?? '';
            $cpf = $data['cpf'] ?? '';

            // Validar o CPF
            if (!$validateDataUser->validarCPF($cpf)) {
                http_response_code(400);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'CPF digitado é inválido.'
                ]);
                return;
            }

            // Verificar se o paciente está registrado e obter o ID do paciente
            $patientId = $this->model->checkPatient($cpf);
            if (!$patientId) {
                http_response_code(401);
                echo json_encode([
                    'status' => 'error',
                    'message' => "Paciente com CPF $cpf não está cadastrado."
                ]);
                return;
            }

            // Adicionar os agendamentos selecionados
            $messages = [];
            foreach ($selectedSchedules as $id) {
                if ($this->model->addSchedule($id, 'secretaria', $secretaryId, $cpf)) {
                    // $messages[] = "Agendamento feito com sucesso!";
                    http_response_code(200);
                    echo json_encode([
                        'status' => 'success',
                        'messages' => "Agendamento feito com sucesso!"
                    ]);
                } else {
                    
                    http_response_code(500);
                    echo json_encode([
                        'status' => 'error',
                        'messages' =>  "Falha ao selecionar o horario com ID $id."
                    ]);
                }
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
?>
