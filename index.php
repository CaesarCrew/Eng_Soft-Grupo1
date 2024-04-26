<?php

require __DIR__ . "/vendor/autoload.php";


$dotenv =  Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$connect = new Connect();
$connect->getConnection();

$url = isset($_GET['url']) ? $_GET['url'] : '/';
switch ($url) {
    case '/':
        include 'app/views/homeView.php';
        break;
    case 'agenda':
        include 'app/views/secretary/SchedulingSecretaryView.php';
        break;
    case 'cadastro':
        include 'app/views/user/authUserView.php';
        break;
    case 'loginSecretaria':
        include 'app/views/secretary/LoginSecretaryView.php';
        break;
    default:
        include 'app/views/erro_404.php';
        break;
}









// // $connect = new Connect();
// // $connect->getConnection();

// // try {
// //     $data = router();
// //     $viewName = $data["view"];
// //     extract($data["data"]); 
// //     if(!isset($viewName)){
// //         throw new Exception(("faltando o index da view"));
// //     }

// //     if(!file_exists(VIEWS.$viewName)){

// //         throw new Exception(("view {$viewName} não encontrada"));
// //     }

// //     require VIEWS."indexView.php";
// // } catch (Exception $e) {
// //     require VIEWS."erro_404.php";
// // }

// // 
