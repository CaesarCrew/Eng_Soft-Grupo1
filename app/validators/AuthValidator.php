<?php

namespace app\validators;

use app\model\AuthUserModel;

class AuthValidator{
    public function ValidatorSignUp($nome , $senha , $email , $telefone , $cpf , $genero , $data_de_nascimento){
            $AuthUserModel = new AuthUserModel;

            function validarCPF($cpf) {
        
                $soma = 0;
            
                if (!preg_match('/^[0-9]+$/', $cpf)){
                    return false;
                }
                
                if (strlen($cpf) != 11) {
                    
                    return false;
                }
            
                if (preg_match('/(\d)\1{10}/', $cpf)) {
                    
                    return false;
                }
                
                $soma = 0;
                for ($i = 0; $i < 9; $i++) {
                    $soma += ((10 - $i) * $cpf[$i]);
                }
                $dv1 = 11 - ($soma % 11);
                if ($dv1 == 10 || $dv1 == 11) {
                    $dv1 = 0;
                }
            
                $soma = 0;
                for ($i = 0; $i < 10; $i++) {
                    $soma += ((11 - $i) * $cpf[$i]);
                }
                $dv2 = 11 - ($soma % 11);
                if ($dv2 == 10 || $dv2 == 11) {
                    $dv2 = 0;
                }
            
            
                if ($dv1 == $cpf[9] && $dv2 == $cpf[10]) {
                    return true; 
                } else {
                    return false;
                }
            }
            
              function validarDataNascimento($dataNascimento) {
                
                $dataNasc = new \DateTime($dataNascimento);
                
               
                $hoje = new \DateTime();
                $idade = $hoje->diff($dataNasc)->y;
            
                
                if ($idade >= 18 && $idade <= 130) {
                    return true; 
                } else {
                    return false;
                }
            }

            if(!preg_match('/^[a-zA-Z\s]+$/', $nome)){
                echo "nome pode conter só letras e espaço";
                return false;
            }
            if (!preg_match('/(?=.*[A-Za-z])(?=.*\d)/', $senha)) {
                echo "A senha deve contém pelo menos uma letra e um número.";
                return false;
            }else{
               
            }
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if(!$AuthUserModel->chackOutEmail($email)){
                    echo "Email já cadastado";
                    return false;
                }
            }else{
                echo "email invalido";
                return false;
            }
    
           
            if (preg_match('/^[0-9]+$/', $telefone)){
                if(!$AuthUserModel->chackOutTelefone($telefone)){
                    echo "telefone já cadastado";
                    return false;
                }
            }else{
                echo "digite apenas numero";
                return false;
            }
    
            
            if(validarCPF($cpf)){
                if(!$AuthUserModel->chackOutCpf($cpf)){
                    echo "cpf já cadastado";
                    return false;
                }
            }else{
                echo "cpf invalido";
                return false;
            }
    
           
            if(!$genero === "F" || !$genero === "M"){
                echo "genero incorreto";
                return false;
            }
    
            
            $formatoData = 'Y-m-d'; 
            $dateTime = \DateTime::createFromFormat($formatoData, $data_de_nascimento);
            if (!$dateTime || $dateTime->format($formatoData) !== $data_de_nascimento) {
                echo "A data $data_de_nascimento não é válida.";
                return  false;
            }
            $dateTime =  $dateTime->format('Y-m-d');
            if (!validarDataNascimento($dateTime)) {
                echo "Data de nascimento inválida.";
                return false;
            }
    
            return true;
    
        
    }
}

