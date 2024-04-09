<?php

require __DIR__ ."/vendor/autoload.php";



$dotenv =  Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


connect();

try {
    $data = router();
    $viewName = $data["view"];
    extract($data["data"]); 
    if(!isset($viewName)){
        throw new Exception(("faltando o index da view"));
    }

    if(!file_exists(VIEWS.$viewName)){
        var_dump(VIEWS.$viewName);
        throw new Exception(("view {$viewName} não encontrada"));
    }
    $view = $viewName;
    require VIEWS."indexView.php";
} catch (Exception $e) {
    require VIEWS."erro_404.php";
}

?>

