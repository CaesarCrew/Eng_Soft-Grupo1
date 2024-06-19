<?php
// nome do arquivo: smtp.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function getConfiguredMailer() {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = ''; // trocar pelo seu usuario
    $mail->Password = '';; // trocar pelo sua senha
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'utf-8';
    
    return $mail;
}
?>