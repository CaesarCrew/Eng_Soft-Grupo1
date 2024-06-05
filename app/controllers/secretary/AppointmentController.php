<?php
namespace app\controllers\secretary;

class AppointmentController {
    public function showLAppointment(){
        return[
                    "view" => "secretary/AppointmentView.php",
                    "data" => ["title" => "Login Secretaria"]
                ];

    }
}