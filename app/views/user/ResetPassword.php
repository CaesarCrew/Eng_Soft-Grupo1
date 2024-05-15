<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mysqli = new mysqli('localhost', 'root', '', 'HealthConnect');
if ($mysqli->connect_error) {
    die('Erro de conexão: ' . $mysqli->connect_error);
}

$userEmail = $_POST['email'] ?? '';

$query = $mysqli->prepare("SELECT * FROM usuario WHERE email = ?");
$query->bind_param("s", $userEmail);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'a166241e8e8b4e';
        $mail->Password = '43ec379524d21a';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'uft8';
        
        $mail->setFrom('atendimento2013@healthconnect.com', 'HealthConnect');
        $mail->addAddress($userEmail);
        $mail->Subject = 'Redefinição de senha';
        $mail->isHTML(true);

        $token = bin2hex(random_bytes(32));
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));
        $stmt = $mysqli->prepare("UPDATE usuario SET reset_token = ?, reset_expires = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expires, $userEmail);
        $stmt->execute();
        
        $mail->Body = 'Olá! Clique no link a seguir para redefinir sua senha: <a href="http://localhost/app/views/user/ResetPasswordConfirm.php?token=' . urlencode($token) . '">Redefinir senha</a>';
        
        $mail->send();
        echo 'Email enviado com sucesso! Verifique sua caixa de entrada para redefinir sua senha.';
    } catch (Exception $e) {
        echo 'O email não pôde ser enviado. Erro: ', $mail->ErrorInfo;
    }
} else {
    echo 'O email não pode ser enviado porque o endereço de email é inválido.';
}

$mysqli->close();
?>