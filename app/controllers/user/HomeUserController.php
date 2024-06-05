<?php

namespace app\controllers\user;

class homeUserController{
    public function showHomeUser(){
        return[
            "view" => "user/homeUserView.php",
            "data" => ["title" => "home" ,  "style" =>"public/css/user/homeUser.css"]
        ];
    }

    

}