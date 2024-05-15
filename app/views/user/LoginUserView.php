<?php
use app\database\AuthUserModel;

class LoginUserController {
    public function login() {
        $AuthUserModel = new AuthUserModel;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!empty($_POST["email"]) && !empty($_POST["senha"])) {
                $email = $_POST["email"];
                $senha = $_POST["senha"];

                $user_id = $AuthUserModel->checkUser($email, $senha);
                
                if ($user_id) {
                    $_SESSION['user_id'] = $user_id;
                    echo "Sucesso!"; // Fazer direcionamento paara a pagina de agendamento
                    header('Location: http://localhost/homeUsuario');
                    exit();
                } else {
                    echo "Email ou senha incorretos.";
                }
            } 
        }
    }
}

$LoginUserController = new LoginUserController;
$LoginUserController->login();
?>

<h1>Login Usuário</h1>

<div class="form_login">
    <form method="POST" action="/login">
        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email" required><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
        <input type="submit" name="submit" value="Enviar">
    </form>
    <a href="app/views/user/SendMailPassword.php">Esqueceu sua senha?</a>
</div>