<?php
require_once 'app/database/AuthSecretaryModel.php';
use app\database\AuthSecretary;
class AuthUserController{

    public function login() {
        $AuthSecretary = new AuthSecretary;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!empty($_POST["usuario"]) && !empty($_POST["senha"])) {
                $usuario = $_POST["usuario"];
                $senha = $_POST["senha"];

                $isValidUser = $AuthSecretary->checkUser($usuario, $senha);
                
                if ($isValidUser) {
                    echo "Sucesso!"; // Fazer direcionamento paara a pagina de agendamento
                } else {
                    echo "Usuário ou senha incorretos.";
                }
            } 
        }
    }
}

?>

<?php
$authUserController = new AuthUserController;
$authUserController->login();
?>

<h1>Login Secretaria</h1>

<div class="form_login">
    <form method="POST" action="/teste2/loginSecretaria">
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
        <input type="submit" name="submit" value="Enviar">
    </form>
</div>