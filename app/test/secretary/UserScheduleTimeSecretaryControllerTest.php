<?php

use PHPUnit\Framework\TestCase;

class UserScheduleTimeSecretaryControllerTest extends TestCase
{
    private $sessionId;

    protected function setUp(): void
    {
        $this->sessionId = file_get_contents("session_id.txt");
        if ($this->sessionId === false || empty($this->sessionId)) {
            $this->fail("Não foi possível ler o ID da sessão ou o arquivo está vazio");
        }
    }

    private function postSelectTime(array $postData)
    {
        $postDataJSON = json_encode($postData);
        $ch = curl_init('http://localhost/selecionarHorario_paciente');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataJSON);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($postDataJSON)
        ]);
        $session_cookie = session_name() . '=' . $this->sessionId;
        curl_setopt($ch, CURLOPT_COOKIE, $session_cookie);
        $responseContent = curl_exec($ch);

        return ['ch' => $ch, 'content' => $responseContent];
    }

    private function getAvailableSchedules()
    {
        $ch = curl_init('http://localhost/agendarHorariosAPI');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $session_cookie = session_name() . '=' . $this->sessionId;
        curl_setopt($ch, CURLOPT_COOKIE, $session_cookie);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->fail("Erro ao decodificar o JSON: " . json_last_error_msg());
        }

        if (!isset($data['dados']) || !is_array($data['dados'])) {
            $this->fail("'dados' não está presente ou não é um array na resposta JSON");
        }

        return $data['dados'];
    }

    public function testGetAvailableSchedules()
    {
        $schedules = $this->getAvailableSchedules();
        $this->assertNotEmpty($schedules, "A lista de horários disponíveis está vazia");
    }

    public function testSelectTime()
    {
        $schedules = $this->getAvailableSchedules();
        $selectedSchedules = array_column($schedules, 'id');
        if (empty($selectedSchedules)) {
            $this->fail("Nenhum horário disponível para seleção");
        }
       
        $postData = [
            'selected_schedules' => [$selectedSchedules[1]],
            'user_id' => '1'
            
        ];
        $response = $this->postSelectTime($postData);
        
        $data = json_decode($response['content'], true);
        

        $this->assertEquals('success', $data["status"]);
    }

    public function testSelectTimeWithInvalidData()
    {
        $postData = [
            'selected_schedules' => [],
            'user_id' => ''
            
        ];
        $response = $this->postSelectTime($postData);
        
        $statusCode = curl_getinfo($response['ch'], CURLINFO_HTTP_CODE);
        $this->assertEquals(405, $statusCode, "O status code esperado era 400 para dados inválidos");

        curl_close($response['ch']);
    }

    public function testSelectTimeWithoutSession()
    {
        $postData = [
            'selected_schedules' => [1],
            'user_id' => '1',
         
        ];

        $postDataJSON = json_encode($postData);
        $ch = curl_init('http://localhost/selecionarHorario_paciente');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataJSON);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($postDataJSON)
        ]);
        $responseContent = curl_exec($ch);

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->assertEquals(302, $statusCode, "O status code esperado era 403 para requisições sem sessão");

        curl_close($ch);
    }

}

