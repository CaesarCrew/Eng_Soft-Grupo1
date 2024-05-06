<?php 
namespace app\middleware;

class MiddlewareSession {

    public function __construct(){
        session_set_cookie_params(['lifetime' => 0, 'httponly' => true]);
        session_start();
        
    }

    public function handleUser(){
       if(!isset($_SESSION['user_id'])){
            header('Location: login.php');
            exit();
        }
    }
    public function handleSecretary(){
          if(!isset($_SESSION['secretary_id'])){
            header('Location: http://localhost/loginSecretaria');
            exit();
        }
    }


}
?>