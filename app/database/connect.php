<?php
require_once 'database.php';
function connect(){

    $pdo = new PDO("mysql:host=".$_ENV['DB_HOST']
    ,$_ENV['DB_USERNAME']
    ,$_ENV['DB_PASSWORD']
    );
    checkBankAndTable($pdo , $_ENV['DB_NAME']);
}
