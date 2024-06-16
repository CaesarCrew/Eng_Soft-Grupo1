<?php

use PHPUnit\Framework\TestCase;

class AuthSecretaryControllerTest extends TestCase {

    private function simulatePostRequest($url, $postData) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function testValidCredentials() {
        $postData = [
            'usuario' => '123',
            'senha' => '123'
        ];
        $output = $this->simulatePostRequest('http://localhost/loginSecretaria', $postData);

        $this->assertStringContainsString('"status":"success"', $output, "Teste de login com credenciais válidas falhou.");
    }

    public function testInvalidCredentials() {
        $postData = [
            'usuario' => 'invalid_user',
            'senha' => 'invalid_password'
        ];
        $output = $this->simulatePostRequest('http://localhost/loginSecretaria', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de login com credenciais inválidas falhou.");
    }

    public function testIncompleteData() {
        $postData = [
            'usuario' => 'valid_user'
        ];
        $output = $this->simulatePostRequest('http://localhost/loginSecretaria', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de login com dados incompletos falhou.");
    }
}
?>
