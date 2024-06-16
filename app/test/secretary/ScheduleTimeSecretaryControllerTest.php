<?php
namespace app\controllers\secretary;

use PHPUnit\Framework\TestCase;

class ScheduleTimeSecretaryControllerTest extends TestCase
{
    public function testSelectTime()
{
    $controller = new ScheduleTimeSecretaryController();

    // Simula os dados do POST
    $postData = [
        'selected_schedules' => [1, 2],
        'secretary_id' => 'secretary123',
        'cpf' => '123.456.789-09'
    ];
    $postDataJSON = json_encode($postData);

    // Configura a requisição cURL
    $ch = curl_init('http://localhost/consultorio/app/controllers/secretary/ScheduleTimeSecretaryController.php');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataJSON);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($postDataJSON)
    ]);

    // Executa a requisição
    $result = curl_exec($ch);

    // Verifica se a requisição foi bem-sucedida
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Verifica se o status code é 200
    $this->assertEquals($statusCode, 200);

    // Verifica se o output está correto
    $expectedOutput = json_encode([
        'status' => 'success',
        'messages' => ['Agendamento feito com sucesso!', 'Agendamento feito com sucesso!']
    ]);
    $this->assertEquals($result, $expectedOutput);
}

}
