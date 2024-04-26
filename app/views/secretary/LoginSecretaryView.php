<?php

use app\database\AuthSecretaryModel;
class AuthUserController{

    public function login() {
        $AuthSecretaryModel = new AuthSecretaryModel;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!empty($_POST["usuario"]) && !empty($_POST["senha"])) {
                $usuario = $_POST["usuario"];
                $senha = $_POST["senha"];

                $isValidUser = $AuthSecretaryModel->checkUser($usuario, $senha);
                
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
    <form method="POST" action="/loginSecretaria">
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
        <input type="submit" name="submit" value="Enviar">
    </form>
</div>