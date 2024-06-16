<?php
use PHPUnit\Framework\TestCase;

class AuthUserControllerTest extends TestCase {
    protected static $token;
    private function simulatePostRequest($url, $postData) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function testValidSignUp() {
        $postData = [
            'nome' => 'Test User',
            'senha' => 'G@briel2808',
            'email' => 'test@example.com',
            'telefone' => '123456789',
            'cpf' => '24761283092',
            'genero' => 'M',
            'data_de_nascimento' => '1990-01-01',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Centro',
            'cidade' => 'Cidade Teste',
            'estado' => 'TT'
        ];

        $output = $this->simulatePostRequest('http://localhost/cadastro', $postData);

        $this->assertStringContainsString('"status":"success"', $output, "Teste de cadastro com dados válidos falhou.");
    }

    public function testInvalidSignUp() {
        $postData = [
            'nome' => 'Test User',
            'senha' => 'testpassword',
            'email' => 'test@example.com',
            'telefone' => '123456789',
            'cpf' => '123',
            'genero' => 'X',
            'data_de_nascimento' => '2024-01-01',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Centro',
            'cidade' => 'Cidade Teste',
            'estado' => 'TT'
        ];

        $output = $this->simulatePostRequest('http://localhost/cadastro', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de cadastro com dados inválidos falhou.");
    }

    public function testValidSignIn() {
        $postData = [
            'email' => 'test@example.com',
            'senha' => 'G@briel2808'
        ];

        $output = $this->simulatePostRequest('http://localhost/login', $postData);

        $this->assertStringContainsString('"status":"success"', $output, "Teste de login com dados válidos falhou.");
    }

    public function testInvalidSignIn() {
        $postData = [
            'email' => 'test@example.com',
            'senha' => 'invalidpassword'
        ];

        $output = $this->simulatePostRequest('http://localhost/login', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de login com dados inválidos falhou.");
    }

    public function testInvalidAddress() {
        $postData = [
            'nome' => 'Test User',
            'senha' => 'G@briel2808',
            'email' => 'test@example.com',
            'telefone' => '123456789',
            'cpf' => '24761283092',
            'genero' => 'M',
            'data_de_nascimento' => '1990-01-01',
            'cep' => '12345',  // CEP inválido
            'logradouro' => '',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Centro',
            'cidade' => 'Cidade Teste',
            'estado' => 'TT'
        ];

        $output = $this->simulatePostRequest('http://localhost/cadastro', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de cadastro com endereço inválido falhou.");
    }

    public function testInvalidPhoneNumber() {
        $postData = [
            'nome' => 'Test User',
            'senha' => 'G@briel2808',
            'email' => 'test@example.com',
            'telefone' => 'abc123', // Telefone inválido
            'cpf' => '24761283092',
            'genero' => 'M',
            'data_de_nascimento' => '1990-01-01',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Centro',
            'cidade' => 'Cidade Teste',
            'estado' => 'TT'
        ];

        $output = $this->simulatePostRequest('http://localhost/cadastro', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de cadastro com telefone inválido falhou.");
    }

    public function testInvalidCPF() {
        $postData = [
            'nome' => 'Test User',
            'senha' => 'G@briel2808',
            'email' => 'test@example.com',
            'telefone' => '123456789',
            'cpf' => '00000000000', // CPF inválido
            'genero' => 'M',
            'data_de_nascimento' => '1990-01-01',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Centro',
            'cidade' => 'Cidade Teste',
            'estado' => 'TT'
        ];

        $output = $this->simulatePostRequest('http://localhost/cadastro', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de cadastro com CPF inválido falhou.");
    }

    public function testInvalidBirthDate() {
        $postData = [
            'nome' => 'Test User',
            'senha' => 'G@briel2808',
            'email' => 'test@example.com',
            'telefone' => '123456789',
            'cpf' => '24761283092',
            'genero' => 'M',
            'data_de_nascimento' => '2024-01-01', // Data de nascimento inválida
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Centro',
            'cidade' => 'Cidade Teste',
            'estado' => 'TT'
        ];

        $output = $this->simulatePostRequest('http://localhost/cadastro', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de cadastro com data de nascimento inválida falhou.");
    }

    public function testInvalidEmail() {
        $postData = [
            'nome' => 'Test User',
            'senha' => 'G@briel2808',
            'email' => 'invalid-email', // Email inválido
            'telefone' => '123456789',
            'cpf' => '24761283092',
            'genero' => 'M',
            'data_de_nascimento' => '1990-01-01',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Centro',
            'cidade' => 'Cidade Teste',
            'estado' => 'TT'
        ];

        $output = $this->simulatePostRequest('http://localhost/cadastro', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de cadastro com e-mail inválido falhou.");
    }

    public function testWeakPassword() {
        $postData = [
            'nome' => 'Test User',
            'senha' => '123456', // Senha fraca
            'email' => 'test@example.com',
            'telefone' => '123456789',
            'cpf' => '24761283092',
            'genero' => 'M',
            'data_de_nascimento' => '1990-01-01',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Centro',
            'cidade' => 'Cidade Teste',
            'estado' => 'TT'
        ];

        $output = $this->simulatePostRequest('http://localhost/cadastro', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de cadastro com senha fraca falhou.");
    }

    public function testShortPhoneNumber() {
        $postData = [
            'nome' => 'Test User',
            'senha' => 'G@briel2808',
            'email' => 'test@example.com',
            'telefone' => '12345', // Telefone curto
            'cpf' => '24761283092',
            'genero' => 'M',
            'data_de_nascimento' => '1990-01-01',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Centro',
            'cidade' => 'Cidade Teste',
            'estado' => 'TT'
        ];

        $output = $this->simulatePostRequest('http://localhost/cadastro', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de cadastro com número de telefone curto falhou.");
    }

    public function testInvalidGender() {
        $postData = [
            'nome' => 'Test User',
            'senha' => 'G@briel2808',
            'email' => 'test@example.com',
            'telefone' => '123456789',
            'cpf' => '24761283092',
            'genero' => 'InvalidGender', // Gênero inválido
            'data_de_nascimento' => '1990-01-01',
            'cep' => '12345678',
            'logradouro' => 'Rua Teste',
            'numero' => '123',
            'complemento' => '',
            'bairro' => 'Centro',
            'cidade' => 'Cidade Teste',
            'estado' => 'TT'
        ];

        $output = $this->simulatePostRequest('http://localhost/cadastro', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de cadastro com gênero inválido falhou.");
    }

    public function testNonExistentEmailSignIn() {
        $postData = [
            'email' => 'nonexistent@example.com', // Email inexistente
            'senha' => 'G@briel2808'
        ];

        $output = $this->simulatePostRequest('http://localhost/login', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de login com e-mail inexistente falhou.");
    }
   

    public function testInvalidEmailSignIn() {
        $postData = [
            'email' => 'invalid-email', // Email inválido
            'senha' => 'G@briel2808'
        ];

        $output = $this->simulatePostRequest('http://localhost/login', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de login com e-mail inválido falhou.");
    }

    public function testInvalidPasswordSignIn() {
        $postData = [
            'email' => 'test@example.com',
            'senha' => 'invalidpassword' // Senha incorreta
        ];

        $output = $this->simulatePostRequest('http://localhost/login', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de login com senha inválida falhou.");
    }
    public function testSendResetPasswordEmail() {
        $postData = [
            'email' => 'test@example.com'
        ];

        $output = $this->simulatePostRequest('http://localhost/sendMailPassword', $postData);

        $this->assertStringContainsString('"status":"success"', $output, "Teste de envio de email de redefinição de senha falhou.");
        
       
        $response = json_decode($output, true);
        self::$token =$response["token"];
        
        $this->assertArrayHasKey('token', $response, "Token não foi retornado na resposta.");
    }
    
    public function testEmptyTokenResetPassword() {
        $postData = [
            'token' => '',
            'new_password' => 'NewPass123',
            'confirm_password' => 'NewPass123'
        ];
    
        $output = $this->simulatePostRequest('http://localhost/resetPassword', $postData);
    
        $this->assertStringContainsString('"status":"error"', $output, "Teste de redefinição de senha com token vazio falhou.");
    }
    
    public function testEmptyNewPasswordResetPassword() {
        $postData = [
            'token' => self::$token,
            'new_password' => '',
            'confirm_password' => 'NewPass123'
        ];
    
        $output = $this->simulatePostRequest('http://localhost/resetPassword', $postData);
    
        $this->assertStringContainsString('"status":"error"', $output, "Teste de redefinição de senha com nova senha vazia falhou.");
    }
    
    public function testEmptyConfirmPasswordResetPassword() {
        $postData = [
            'token' => self::$token,
            'new_password' => 'NewPass123',
            'confirm_password' => ''
        ];
    
        $output = $this->simulatePostRequest('http://localhost/resetPassword', $postData);
    
        $this->assertStringContainsString('"status":"error"', $output, "Teste de redefinição de senha com confirmação de senha vazia falhou.");
    }
    public function testResetPasswordSuccess() {
        
        $postData = [
            'token' =>   self::$token,
            'new_password' => 'G@briel2808',
            'confirm_password' => 'G@briel2808'
        ];

        $output = $this->simulatePostRequest('http://localhost/resetPassword', $postData);

        $this->assertStringContainsString('"status":"success"', $output, "Teste de redefinição de senha com sucesso falhou.");
    }

    public function testInvalidTokenResetPassword() {
        $postData = [
            'token' => 'invalidToken',
            'new_password' => 'NewPass123',
            'confirm_password' => 'NewPass123'
        ];

        $output = $this->simulatePostRequest('http://localhost/resetPassword', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de redefinição de senha com token inválido falhou.");
    }

    public function testMismatchedPasswordsResetPassword() {
        $postData = [
            'token' => 'validToken',
            'new_password' => 'NewPass123',
            'confirm_password' => 'MismatchedPass123'
        ];

        $output = $this->simulatePostRequest('http://localhost/resetPassword', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de redefinição de senha com senhas não correspondentes falhou.");
    }

    public function testWeakPasswordResetPassword() {
        $postData = [
            'token' => 'validToken',
            'new_password' => '123456', // Senha fraca
            'confirm_password' => '123456'
        ];

        $output = $this->simulatePostRequest('http://localhost/resetPassword', $postData);

        $this->assertStringContainsString('"status":"error"', $output, "Teste de redefinição de senha com senha fraca falhou.");
    }

}
