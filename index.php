<?php
//index.php
use app\middleware\MiddlewareSession;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/app/middleware/MiddlewareSession.php";


$dotenv =  Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$MiddlewareSession = new MiddlewareSession;

$connect = new Connect();
$connect->getConnection();

try {
    $data = router();
    
    $viewName = $data["view"];
    extract($data["data"]); 
    if(!isset($viewName)){
        throw new Exception(("faltando o index da view"));
    }

    if(!file_exists(VIEWS.$viewName)){
        throw new Exception(("view {$viewName} não encontrada"));
    }

    require VIEWS."indexView.php";
} catch (Exception $e) {
    echo $e;
    require VIEWS."erro_404.php";
}


