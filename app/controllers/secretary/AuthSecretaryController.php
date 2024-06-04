<?php
namespace app\controllers\secretary;

use  app\model\AuthSecretaryModel;

class AuthSecretaryController{
    
    public function showLoginSecretary(){
        return[
                    "view" => "secretary/loginSecretaryView.php",
                   "data" => ["title" => "Login Secretaria",  "style" =>"public/css/secretary/LoginSecretary.css"]
                ];

    }
    public function logoutSecretary(){
        return $this->showLoginSecretary();
    }

    public function signIn() {
        $AuthSecretaryModel = new AuthSecretaryModel;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = json_decode(file_get_contents('php://input'), true);
            
        
           
            if (!empty($data["usuario"]) && !empty($data["senha"])) {
                $usuario = $data["usuario"];
                $senha = $data["senha"];

                $secretary_id = $AuthSecretaryModel->checkUser($usuario, $senha);

                if ($secretary_id) {
                    $_SESSION['secretary_id'] = $secretary_id;
                    http_response_code(200);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Login successful'
                    ]);
                } else {
                    
                    http_response_code(401);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Usuario ou senha incorretos.'
                    ]);
                }
            } else {
                
                http_response_code(400);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Dados incompletos.'
                ]);
            }
        } else {
            
            http_response_code(405);
            echo json_encode([
                'status' => 'error',
                'message' => 'Método não permitido.'
            ]);
        }
    }
    
}

?>