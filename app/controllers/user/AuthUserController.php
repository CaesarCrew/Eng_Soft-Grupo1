<?php

namespace app\controllers\user;

use app\model\AuthUserModel;
use app\validators\AuthValidator;
use PHPMailer\PHPMailer\Exception;

//require 'smtp.php'; //adicionar arquivo stmp.php com a sua configuração do stmp
class authUserController {
    
    public function showSignUp() {
        return [
            "view" => "user/signUpUserView.php",
            "data" => ["title" => "Cadastro"]
        ];
    }
    
    public function signUp() {
        $AuthUserModel = new AuthUserModel;
        $validateDataUser = new AuthValidator;

        if (
            !empty($_POST["nome"]) &&
            !empty($_POST["senha"]) &&
            !empty($_POST["email"]) &&
            !empty($_POST["telefone"]) &&
            !empty($_POST["cpf"]) &&
            !empty($_POST["genero"]) &&
            !empty($_POST["data_de_nascimento"])
        ) {
            
            $nome = $_POST["nome"];
            $senha = $_POST["senha"];
            $email = $_POST["email"];
            $telefone = $_POST["telefone"];
            $cpf = $_POST["cpf"];
            $genero = $_POST["genero"];
            $data_de_nascimento = $_POST["data_de_nascimento"];

            $validateDataUSer = $validateDataUser->ValidatorSignUp($nome , $senha , $email , $telefone , $cpf , $genero , $data_de_nascimento);
            if (!$validateDataUSer) {
                return $this->showSignUp();
            }

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $formatoData = 'Y-m-d'; 
            $dateTime = \DateTime::createFromFormat($formatoData, $data_de_nascimento);
            $dateTime =  $dateTime->format('Y-m-d');
            
            $cep = $_POST["cep"];
            $logradouro = $_POST["logradouro"];
            $numero = $_POST["numero"];
            $complemento = $_POST["complemento"];
            $bairro = $_POST["bairro"];
            $cidade = $_POST["cidade"];
            $estado = $_POST["estado"];
            
            $AuthUserModel->signUp($nome, $senhaHash, $email, $telefone, $cpf, $genero, $dateTime , $cep ,$logradouro ,$numero ,$complemento ,$bairro , $cidade , $estado);
            echo "cadastro bem-sucedido";
            echo "<script>setTimeout(() => { window.location.href = 'http://localhost/login'; }, 2000);</script>";
            return $this->showSignUp();
        
        } else {
            echo "Por favor, preencha todos os campos.";
            return $this->showSignUp();
        }
    }
    
    public function ShowSignIn() {
        return [
            "view" => "user/signInUserView.php",
            "data" => ["title" => "Login"]
        ];
    }

    public function signIn() {
        $AuthUserModel = new AuthUserModel;

        if (!empty($_POST["email"]) && !empty($_POST["senha"])) {
            $email = $_POST["email"];
            $senha = $_POST["senha"];

            $user_id = $AuthUserModel->checkUser($email, $senha);
            
            if ($user_id) {
                $_SESSION['user_id'] = $user_id;
                echo "Sucesso!"; // Fazer direcionamento paara a pagina de agendamento
                header('Location: http://localhost/home');
                exit();
            } else {
                
                echo "Email ou senha incorretos.";
                return $this->showSignIn();
            }
        } 
    }

    public function logoutUser() {
        return $this->ShowSignIn();
    }

    public function showSendMailPassword() {
        return [
            "view" => "user/SendMailPasswordView.php",
            "data" => ["title" => "Redefinir Senha"]
        ];
    }

    public function sendResetPasswordEmail() {
        $userEmail = $_POST['email'] ?? '';
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
                echo 'Email enviado com sucesso! Verifique sua caixa de entrada para redefinir sua senha.';
            } catch (Exception $e) {
                echo 'O email não pôde ser enviado. Erro: ', $mail->ErrorInfo;
            }
        } else {
            echo 'O email não pode ser enviado porque o endereço de email é inválido.';
        }
    }

    public function showResetPasswordConfirm() {
        return [
            "view" => "user/ResetPasswordConfirmView.php",
            "data" => ["title" => "Confirmar Redefinição de Senha"]
        ];
    }

    public function resetPassword() {
        $token = $_POST['token'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $authUserModel = new AuthUserModel();
        if ($authUserModel->isValidToken($token)) {
            if ($newPassword && ($newPassword === $confirmPassword)) {
                $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $authUserModel->updatePassword($token, $newPasswordHash);
                echo 'Sua senha foi redefinida com sucesso!';
                echo '<a href="http://localhost/login">Ir para Login</a>';
            } else {
                echo 'As senhas não coincidem ou senha inválida.';
                echo '<a href="javascript:history.back()">Tentar novamente</a>';
            }
        } else {
            echo 'Token inválido ou expirado.';
            echo '<a href="http://localhost/app/views/user/SendMailPasswordView.php">Tente Novamente</a>';
        }
    }
}
?>
