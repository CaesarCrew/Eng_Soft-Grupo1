<?php

namespace app\controllers\user;

use app\model\AuthUserModel;
use app\validators\AuthValidator;
use app\validators\AddressValidator;
use PHPMailer\PHPMailer\Exception;

require 'smtp.php'; //adicionar arquivo stmp.php com a sua configuração do stmp
class authUserController {
    
    public function showSignUp() {
        return [
            "view" => "user/signUpUserView.php",
            "data" => ["title" => "Cadastro" ,  "style" =>"public/css/user/signUpUser.css"]
        ];
    }
    public function signUp() {
        $AuthUserModel = new AuthUserModel;
        $validateDataUser = new AuthValidator;
    
        $data = json_decode(file_get_contents('php://input'), true);
    
        if (
            !empty($data["nome"]) &&
            !empty($data["senha"]) &&
            !empty($data["email"]) &&
            !empty($data["telefone"]) &&
            !empty($data["cpf"]) &&
            !empty($data["genero"]) &&
            !empty($data["data_de_nascimento"])
        ) {
            
            $nome = $data["nome"];
            $senha = $data["senha"];
            $email = $data["email"];
            $telefone = $data["telefone"];
            $cpf = $data["cpf"];
            $genero = $data["genero"];
            $data_de_nascimento = $data["data_de_nascimento"];
            
            $response = $validateDataUser->ValidatorSignUp($nome, $senha, $email, $telefone, $cpf, $genero, $data_de_nascimento);
            if (!$response) {
                
                http_response_code(400); // Bad Request
                echo json_encode(["status" => "error", "message" => "Dados de validacao invalidos."]);
                return;
            }
    
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    
            $formatoData = 'Y-m-d'; 
            $dateTime = \DateTime::createFromFormat($formatoData, $data_de_nascimento);
            $dateTime = $dateTime->format('Y-m-d');
            
            $cep = isset($data["cep"]) ? $data["cep"] : null;
            $logradouro = isset($data["logradouro"]) ? $data["logradouro"] : null;
            $numero = isset($data["numero"]) ? $data["numero"] : null;
            $complemento = isset($data["complemento"]) ? $data["complemento"] : null;
            $bairro = isset($data["bairro"]) ? $data["bairro"] : null;
            $cidade = isset($data["cidade"]) ? $data["cidade"] : null;
            $estado = isset($data["estado"]) ? $data["estado"] : null;
            
            $AddressValidator = new AddressValidator;

            $response = $AddressValidator->validator($cep,$logradouro,$numero,$bairro,$cidade,$estado);
            if (!$response) {
                
                http_response_code(400); // Bad Request
                echo json_encode(["status" => "error", "message" => "Dados de validacao invalidos."]);
                return;
            }

            $singUpSalve = $AuthUserModel->signUp($nome, $senhaHash, $email, $telefone, $cpf, $genero, $dateTime, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $estado);
            
            if($singUpSalve){
                http_response_code(400); // Bad Request
                echo json_encode(["status" => "error", "message" => "Erro ao salvar dados"]);
                return;
            }
                http_response_code(200); // OK
                echo json_encode(["status" => "success", "message" => "Cadastro bem-sucedido."]);
        
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(["status" => "error", "message" => "Por favor, preencha todos os campos."]);
        }
    }
    
    
    public function ShowSignIn() {
        return [
            "view" => "user/signInUserView.php",
            "data" => ["title" => "Login" ,  "style" =>"public/css/user/signInUser.css"]
        ];
    }

    public function signIn() {
        $AuthUserModel = new AuthUserModel;
        $data = json_decode(file_get_contents('php://input'), true);
    
        if (!empty($data["email"]) && !empty($data["senha"])) {
            $email = $data["email"];
            $senha = $data["senha"];
    
            $user_id = $AuthUserModel->checkUser($email, $senha);
    
            if ($user_id) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['tipo_usuario'] = 'usuario';

                echo json_encode(["status" => "success", "message" => "Autenticacao bem-sucedida!"]);
                http_response_code(200); 
            } else {
                echo json_encode(["status" => "error", "message" => "Email ou senha incorretos."]);
                http_response_code(401); 
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Email e senha sao obrigatorios."]);
            http_response_code(400); 
        }
    }
    
    
    
    public function logoutUser() {
        return $this->ShowSignIn();
    }

    public function showSendMailPassword() {
        return [
            "view" => "user/sendMailPasswordView.php",
            "data" => ["title" => "Redefinir Senha" ,  "style" =>"public/css/user/sendMailPassword.css"]
        ];
    }

    public function sendResetPasswordEmail() {
        $data = json_decode(file_get_contents('php://input'), true);
        $userEmail = $data ['email'] ?? '';
        $authUserModel = new AuthUserModel();
       
        if ($authUserModel->isEmailExists($userEmail)) {
            try {
                $mail = getConfiguredMailer();
    
                $mail->setFrom('atendimento@healthconnect.com', 'HealthConnect');
                $mail->addAddress($userEmail);
                $mail->Subject = 'Redefinição de senha';
                $mail->isHTML(true);
    
                $token = bin2hex(random_bytes(32));
                $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));
    
                $authUserModel->storeResetToken($userEmail, $token, $expires);
    
                $mail->Body = 'Olá! Clique no link a seguir para redefinir sua senha: <a href="http://localhost/resetPasswordConfirm?token=' . urlencode($token) . '">Redefinir senha</a>';
    
                $mail->send();
                echo json_encode(['status' => 'success', 'message' => 'Email enviado com sucesso! Verifique sua caixa de entrada para redefinir sua senha.'  , "token" => $token]);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => 'O email não pôde ser enviado. Erro: ' . $mail->ErrorInfo]);
            }
        } else {
            
            echo json_encode(['status' => 'error', 'message' => 'O email não pode ser enviado porque o endereço de email é inválido.']);
        }
    }
    
    public function showResetPasswordConfirm() {
        return [
            "view" => "user/resetPasswordConfirmView.php",
            "data" => ["title" => "Confirmar Redefinição de Senha" ,  "style" =>"public/css/user/resetPasswordConfirm.css"]
        ];
    }

    public function resetPassword($param) {
        $validateDataUser = new AuthValidator;

        $data = json_decode(file_get_contents('php://input'), true);
        
        $token = $data['token'] ?? '';
        $newPassword = $data['new_password'] ?? '';
        $confirmPassword = $data['confirm_password'] ?? '';
        
        $authUserModel = new AuthUserModel();
        $validateDataUSer = $validateDataUser->validarPassword($newPassword);
        if($validateDataUSer === true){
            if ($authUserModel->isValidToken($token)) {
                

                if ($newPassword && ($newPassword === $confirmPassword)) {
                    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                    $authUserModel->updatePassword($token, $newPasswordHash);
                    echo json_encode(['status' => 'success', 'message' => 'Sua senha foi redefinida com sucesso!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'As senhas não coincidem ou senha inválida.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Token inválido ou expirado.']);
            }
        }else{
            echo json_encode(['status' => 'error', 'message' => 'A senha deve contém pelo menos uma letra e um número. ']);
        }
    }
    
}
?>
