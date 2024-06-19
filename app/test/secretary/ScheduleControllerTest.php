<?php

use PHPUnit\Framework\TestCase;

class ScheduleControllerTest extends TestCase
{
    private $sessionId;
    private static $addedId;

    protected function setUp(): void
    {
        
        $this->sessionId = file_get_contents("session_id.txt");
        if ($this->sessionId === false || empty($this->sessionId)) {
            $this->fail("Não foi possível ler o ID da sessão ou o arquivo está vazio");
        }
    }

    private function simulatePostRequest($url, $postData)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

       
        $session_cookie = session_name() . '=' . $this->sessionId;
        curl_setopt($ch, CURLOPT_COOKIE, $session_cookie);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return ['response' => $response, 'http_code' => $httpCode];
    }

    private function simulateDeleteRequest($url, $id)
    {
        $deleteUrl = $url . '/delete_id/' . $id;
        $ch = curl_init($deleteUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $session_cookie = session_name() . '=' . $this->sessionId;
        curl_setopt($ch, CURLOPT_COOKIE, $session_cookie);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout de 10 segundos
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return ['response' => $response, 'http_code' => $httpCode];
    }

    public function testAddValidSchedule()
    {
        $url = 'http://localhost/horarios';
        $postData = [
            'data' => '2025-06-01',
            'times' => ['09:00' ,'09:15' , '09:30' ,'11:30']
        ];

        $result = $this->simulatePostRequest($url, $postData);
        $responseData = json_decode($result['response'], true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->fail('Falha ao decodificar a resposta JSON');
        }

        $this->assertEquals(201, $result['http_code']);
        $this->assertArrayHasKey('status', $responseData);
        $this->assertEquals('success', $responseData['status']);
        $this->assertArrayHasKey('id', $responseData);

      
        self::$addedId = $responseData['id'];
    }

    public function testAddInvalidTime()
    {
        $url = 'http://localhost/horarios';
        $postData = [
            'data' => '2024-06-01',
            'times' => ['25:00']
        ];

        $result = $this->simulatePostRequest($url, $postData);
        $responseData = json_decode($result['response'], true);

        $this->assertEquals(400, $result['http_code']);
        $this->assertArrayHasKey('status', $responseData);
        $this->assertEquals('error', $responseData['status']);
    }

    public function testAddDuplicateTimes()
    {
        $url = 'http://localhost/horarios';
        $postData = [
            'data' => '2024-06-01',
            'times' => ['09:00', '09:00']
        ];

        $result = $this->simulatePostRequest($url, $postData);
        $responseData = json_decode($result['response'], true);

        $this->assertEquals(400, $result['http_code']);
        $this->assertArrayHasKey('status', $responseData);
        $this->assertEquals('error', $responseData['status']);
    }

    public function testAddPastDate()
    {
        $url = 'http://localhost/horarios';
        $postData = [
            'data' => '2023-01-01',
            'times' => ['09:00']
        ];

        $result = $this->simulatePostRequest($url, $postData);
        $responseData = json_decode($result['response'], true);

        $this->assertEquals(400, $result['http_code']);
        $this->assertArrayHasKey('status', $responseData);
        $this->assertEquals('error', $responseData['status']);
    }
    public function testPutNonExistentSchedule()
    {
        $url = 'http://localhost/horarios';
        $postData = [
            'data' => '2025-06-01',
            'time' => '11:00'
        ];

        
        $nonExistentId = 535;
        $putUrl = $url . '/put_id/' . $nonExistentId;
        $ch = curl_init($putUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $session_cookie = session_name() . '=' . $this->sessionId;
        curl_setopt($ch, CURLOPT_COOKIE, $session_cookie);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $responseData = json_decode($response, true);

        $this->assertEquals(500, $httpCode);
        $this->assertArrayHasKey('status', $responseData);
        $this->assertEquals('error', $responseData['status']);
    }

    public function testPutSchedule()
    {
        $url = 'http://localhost/horarios';
        $postData = [
            'data' => '2025-06-01',
            'time' => '11:00' // Update to 11:00
        ];

        $putUrl = $url . '/put_id/' . self::$addedId;
        $ch = curl_init($putUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $session_cookie = session_name() . '=' . $this->sessionId;
        curl_setopt($ch, CURLOPT_COOKIE, $session_cookie);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $responseData = json_decode($response, true);

        $this->assertEquals(200, $httpCode);
        $this->assertArrayHasKey('status', $responseData);
        $this->assertEquals('success', $responseData['status']);
    }

    public function testDeleteSchedule()
    {
        $url = 'http://localhost/horarios';
        $response = $this->simulateDeleteRequest($url, self::$addedId);
        $responseData = json_decode($response['response'], true);

        $this->assertEquals(200, $response['http_code']);
        $this->assertArrayHasKey('status', $responseData);
        $this->assertEquals('success', $responseData['status']);
    }

    public function testDeleteNonExistentSchedule()
    {
        $url = 'http://localhost/horarios';
        $response = $this->simulateDeleteRequest($url, self::$addedId);
        $responseData = json_decode($response['response'], true);

        $this->assertEquals(500, $response['http_code']);
        $this->assertArrayHasKey('status', $responseData);
        $this->assertEquals('error', $responseData['status']);
    }
}

?>
