<?php

namespace app\test\secretary;

use app\controllers\secretary\ScheduleTimeSecretaryCancelController;
use PHPUnit\Framework\TestCase;
use app\model\ScheduleTimeSecretaryCancelModel;
use PHPUnit\Framework\MockObject\MockObject;

class ScheduleTimeSecretaryCancelControllerTest extends TestCase
{
    /**
     * @var ScheduleTimeSecretaryCancelModel|MockObject
     */
    private $modelMock;

    /**
     * @var ScheduleTimeSecretaryCancelController
     */
    private $controller;

    protected function setUp(): void
    {
        $this->modelMock = $this->createMock(ScheduleTimeSecretaryCancelModel::class);
        $this->controller = new ScheduleTimeSecretaryCancelController();
        $this->controller->setModel($this->modelMock); // Usando o método setModel para injetar o mock
    }

    public function testShowAppointments()
    {
        $expectedAppointments = [
            ['id' => 1, 'data_consulta' => '2024-06-18', 'status_consulta' => 'confirmado'],
            ['id' => 2, 'data_consulta' => '2024-06-19', 'status_consulta' => 'cancelado']
        ];

        $this->modelMock->method('getAppointments')->willReturn($expectedAppointments);

        $result = $this->controller->showAppointments();

        $this->assertEquals('secretary/SchedulesSecretaryViewCancel.php', $result['view']);
        $this->assertEquals($expectedAppointments, $result['data']['appointments']);
    }

    public function testCancelScheduleSuccess()
    {
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['id_consulta'] = 1;

        $this->modelMock->method('cancelSchedule')->willReturn(true);

        $result = $this->controller->cancelSchedule();

        $this->assertEquals('success', $result['status']);
        $this->assertEquals('Agendamento cancelado com sucesso.', $result['message']);
    }

    public function testCancelScheduleFailure()
    {
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['id_consulta'] = 1;

        $this->modelMock->method('cancelSchedule')->willReturn(false);

        $result = $this->controller->cancelSchedule();

        $this->assertEquals('error', $result['status']);
        $this->assertEquals('Falha ao cancelar o agendamento.', $result['message']);
    }

    public function testCancelScheduleInvalidRequest()
    {
        $_SERVER["REQUEST_METHOD"] = "GET";

        $result = $this->controller->cancelSchedule();

        $this->assertEquals('error', $result['status']);
        $this->assertEquals('Método inválido.', $result['message']);
    }
}
?>
