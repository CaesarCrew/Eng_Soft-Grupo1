<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
$mysqli = new mysqli('localhost', 'root', '', 'HealthConnect');
if ($mysqli->connect_error) {
    die('Erro de conexão: ' . $mysqli->connect_error);
}

$token = $_POST['token'] ?? '';
$newPassword = $_POST['new_password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

$stmt = $mysqli->prepare("SELECT * FROM usuario WHERE reset_token = ? AND reset_expires > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    if ($newPassword && ($newPassword === $confirmPassword)) {
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateStmt = $mysqli->prepare("UPDATE usuario SET senha = ?, reset_token = NULL, reset_expires = NULL WHERE reset_token = ?");
        $updateStmt->bind_param("ss", $newPasswordHash, $token);
        $updateStmt->execute();
        
        echo 'Sua senha foi redefinida com sucesso!';
        echo '<a href="http://localhost/login">Ir para Login</a>';
    } else {
        echo 'As senhas não coincidem ou senha inválida.';
        echo '<a href="javascript:history.back()">Tentar novamente</a>';
    }
} else {
    echo 'Token inválido ou expirado.';
    echo '<a href="http://localhost/app/views/user/SendMailPassword.php">Tente Novamente</a>';
}

$mysqli->close();
?>
