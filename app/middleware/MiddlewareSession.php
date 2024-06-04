<?php 
namespace app\middleware;

class MiddlewareSession {

    public function __construct(){
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params(['lifetime' => 0, 'httponly' => true]);
            session_start();
        }
    }

    public function handleUser(){
        if (!isset($_SESSION['user_id']) && !isset($_SESSION['tipo_usuario'])) {
            header('Location: http://localhost/login');
            exit();
        }
    }

    public function handleSecretary(){
        if (!isset($_SESSION['secretary_id']) || $_SESSION['tipo_secretary'] !== 'secretaria') {
            header('Location: /loginSecretaria');
            exit();
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
    }
}
?>
