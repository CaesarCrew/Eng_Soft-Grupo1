<?php

function controller($matchedUri , $params){
    
    [$controller , $method] = explode("@" ,array_values($matchedUri)[0]);
    $controllerwithName= CONTROLLER.$controller;  
    
    

    if(!class_exists($controllerwithName)){
        var_dump($controllerwithName);
        throw new Exception("controller {$controller} não existe");
    }
    
    $controllerInstance = new $controllerwithName;
    
    if(!method_exists($controllerInstance , $method)){
        throw new Exception("method {$method} não existe em  {$controller}  ");
    }

    return $controllerInstance -> $method($params);
    
}
