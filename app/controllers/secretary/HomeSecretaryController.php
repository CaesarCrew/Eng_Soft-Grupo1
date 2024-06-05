<?php
namespace app\controllers\secretary;
class HomeSecretaryController{
    public function ShowDiarySecretary($params){
        return[
            "view" => "secretary/homeSecretaryView.php",
            "data" => ["title" => "Diário Secretário" ,  "style" =>"public/css/secretary/homeSecretary.css"]
        ];
    }
}

?>