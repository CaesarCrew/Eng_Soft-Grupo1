<?php

use app\middleware\MiddlewareSession;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/app/middleware/MiddlewareSession.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, WCTrustedToken, userId, WCToken, PersonalizationID, AUTHUSER, Primarynum');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT');


$dotenv =  Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$MiddlewareSession = new MiddlewareSession;

$connect = new Connect();
$connect->getConnection();

try {
    $data = router();
    if (!empty($data) || !empty($data['data'])){
        $viewName = $data["view"];
        extract($data["data"]); 
        if(!isset($viewName)){
            throw new Exception(("faltando o index da view"));
        }
        
        if(!file_exists(VIEWS.$viewName)){
            
            throw new Exception(("view {$viewName} não encontrada"));
        }
        
        require VIEWS."indexView.php";
    }
} catch (Exception $e) {
    echo $e;
    require VIEWS."erro_404.php";
}



