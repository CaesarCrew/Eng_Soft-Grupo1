<?php
namespace app\validators;

class AddressValidator {
    public function validarCEP($cep) {
        return preg_match('/^[0-9]{8}$/', $cep);
    }

    public function validarLogradouro($logradouro) {
        return !empty($logradouro) && preg_match('/^[\p{L}\s]+$/u', $logradouro);
    }

    public function validarNumero($numero) {
        return !empty($numero) && preg_match('/^[0-9]+$/', $numero);
    }

    public function validarBairro($bairro) {
        return !empty($bairro) && preg_match('/^[\p{L}\s]+$/u', $bairro);
    }

    public function validarCidade($cidade) {
        return !empty($cidade) && preg_match('/^[\p{L}\s]+$/u', $cidade);
    }

    public function validarEstado($estado) {
        return preg_match('/^[A-Z]{2}$/', $estado);
    }
     public function validator($cep,$logradouro,$numero,$bairro,$cidade,$estado)
    {
        if(!$this->validarCEP($cep)){
            return false;
        }
        if(!$this->validarLogradouro($logradouro)){
            return false;
        }
        if(!$this->validarNumero($numero)){
            return false;
        }
        if(!$this->validarBairro($bairro)){
            return false;
        }
        if(!$this->validarCidade($cidade)){
            return false;
        }
        if(!$this->validarEstado($estado)){
            return false;
        }
        return true;
    }
}
