<?php

namespace app\controllers\user;

class HomeUserController{
    public function showHomeUser(){
        return[
            "view" => "user/homeUser.php",
            "data" => ["title" => "home"]
        ];
    }

    

}