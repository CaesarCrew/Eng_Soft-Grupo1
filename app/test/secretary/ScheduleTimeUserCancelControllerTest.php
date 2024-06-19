<?php

use PHPUnit\Framework\TestCase;
use app\controllers\user\ScheduleTimeUserCancelController;
use app\model\ScheduleTimeUserCancelModel;

class ScheduleTimeUserCancelControllerTest extends TestCase
{
    private $controller;
    private $modelMock;
    private $headerMock;

    protected function setUp(): void
    {
        $this->modelMock = $this->createMock(ScheduleTimeUserCancelModel::class);
        $this->headerMock = function ($header) {
            
        };

        $this->controller = new ScheduleTimeUserCancelController($this->headerMock);

        
        $reflection = new \ReflectionClass($this->controller);
        $property = $reflection->getProperty('model');
        $property->setAccessible(true);
        $property->setValue($this->controller, $this->modelMock);
    }

    public function testShowAppointments()
    {
        $_SESSION['user_id'] = 1;
        $appointments = [
            ['id' => 1, 'data' => '2023-06-18', 'status' => 'ativo'],
            ['id' => 2, 'data' => '2023-06-19', 'status' => 'cancelado']
        ];

        $this->modelMock
            ->expects($this->once())
            ->method('getUserAppointments')
            ->with($this->equalTo(1))
            ->willReturn($appointments);

        $result = $this->controller->showAppointments();

        $this->assertEquals('user/SchedulesUserViewCancel.php', $result['view']);
        $this->assertEquals($appointments, $result['data']['appointments']);
        $this->assertEquals('Meus Agendamentos', $result['data']['title']);
        $this->assertEquals('/public/css/user/ScheduleTimeUserCancel.css', $result['data']['style']);
    }

    public function testCancelAppointmentSuccess()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['id_consulta'] = 1;

        $this->modelMock
            ->expects($this->once())
            ->method('cancelAppointment')
            ->with($this->equalTo(1))
            ->willReturn(true);

        ob_start();
        $this->controller->cancelAppointment();
        $output = ob_get_clean();

        $this->assertJsonStringEqualsJsonString(json_encode(['message' => 'Consulta cancelada com sucesso']), $output);
    }

    public function testCancelAppointmentFailure()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['id_consulta'] = 1;

        $this->modelMock
            ->expects($this->once())
            ->method('cancelAppointment')
            ->with($this->equalTo(1))
            ->willReturn(false);

        ob_start();
        $this->controller->cancelAppointment();
        $output = ob_get_clean();

        $this->assertJsonStringEqualsJsonString(json_encode(['message' => 'Falha ao cancelar a consulta']), $output);
    }

    public function testCancelAppointmentInvalidRequest()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';

        ob_start();
        $this->controller->cancelAppointment();
        $output = ob_get_clean();

        $this->assertJsonStringEqualsJsonString(json_encode(['message' => 'Requisição inválida']), $output);
    }
}
?>
