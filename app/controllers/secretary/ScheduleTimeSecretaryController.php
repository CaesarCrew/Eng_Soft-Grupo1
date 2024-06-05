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
            "title" => "Realizar Agendamento"
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
            $selectedSchedules = $_POST['selected_schedules'] ?? [];
            $secretaryId = $_POST['secretary_id'] ?? '';
            $cpf = $_POST['cpf'] ?? '';

            // Validar o CPF
            if (!$validateDataUser->validarCPF($cpf)) {
                return "Cpf digitado é inválido";
            }

            // Verificar se o paciente está registrado e obter o ID do paciente
            $patientId = $this->model->checkPatient($cpf);
            if (!$patientId) {
                return "Paciente com CPF $cpf não está cadastrado.";
            }

            // Adicionar os agendamentos selecionados
            $messages = [];
            foreach ($selectedSchedules as $id) {
                if ($this->model->addSchedule($id, 'secretaria', $secretaryId, $cpf)) {
                    $messages[] = "Agendamento feito com sucesso para o horário com ID $id.";
                } else {
                    $messages[] = "Falha ao selecionar o horário com ID $id.";
                }
            }

            return $messages;
        }

        return "Por favor, envie os dados do formulário via método POST.";
    }
}
