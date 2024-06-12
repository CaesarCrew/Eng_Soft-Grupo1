<?php

namespace app\controllers\user;

class homeUserController{
    public function showHomeUser(){
        return[
            "view" => "user/homeUserView.php",
            "data" => ["title" => "Home" ,  "style" =>"public/css/user/homeUser.css"]
        ];
    }

    

}