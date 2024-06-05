<?php
namespace app\controllers\secretary;

use  app\model\AuthSecretaryModel;

class AuthSecretaryController{
    
    public function showLoginSecretary(){
        return[
                    "view" => "secretary/loginSecretaryView.php",
                    "data" => ["title" => "Login Secretaria"]
                ];

    }
    public function logoutSecretary(){
        return $this->showLoginSecretary();
    }

    public function signIn() {
        $AuthSecretaryModel = new AuthSecretaryModel;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!empty($_POST["usuario"]) && !empty($_POST["senha"])) {
                $usuario = $_POST["usuario"];
                $senha = $_POST["senha"];

                $secretary_id = $AuthSecretaryModel->checkUser($usuario, $senha);
                
                if ($secretary_id) {
                    $_SESSION['secretary_id'] = $secretary_id;
                    $_SESSION['tipo_secretary'] = 'secretaria';
                    header('Location: http://localhost/homeSecretaria');
                    exit();
                } else {
                    
                    echo "Usuário ou senha incorretos.";
                    return $this->showLoginSecretary();
                }
            } 
        }
    }
}

?>

<?php
// $authUserController = new AuthUserController;
// $authUserController->login();
?>
 
