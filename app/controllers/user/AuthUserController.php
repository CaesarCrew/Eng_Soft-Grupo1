<?php

namespace app\controllers\user;

use app\model\AuthUserModel;
use app\validators\AuthValidator;

class authUserController{
    
    public function showSignUp(){
        return[
            "view" => "user/signUpUserView.php",
            "data" => ["title" => "Cadastro"]
        ];
    }
    public function signUp (){
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
            if(!$validateDataUSer){
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
    

    public function ShowSignIn(){
        return[
            "view" => "user/signInUserView.php",
            "data" => ["title" => "Login"]
        ];
    }

    public function signIn(){
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
    public function logoutUser(){
        return $this->ShowSignIn();
    }
}
?>