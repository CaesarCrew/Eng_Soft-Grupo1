<?php

namespace app\controllers;

class HomeController{
    public function index($params){
        return [
            "view" => "homeView.php",
            "data" => [
                "title" => "Home",
                "style" => "public/css/secretary/info.css"
            ]
        ];
    }
}
