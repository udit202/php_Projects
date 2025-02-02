<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

function SendOtp($gmail, $otp){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth=true;
    $mail->Username='uditdhiman993@gmail.com';
    $mail->Password='qvegrmvzjhresfqh';
    $mail->SMTPSecure='ssl';
    $mail->Port=465;
    $mail->setFrom('uditdhiman993@gmail.com');
    $mail->addAddress($gmail);
    $mail->isHTML(true);
    $mail->Subject="Password Reset Otp ";
    $mail->Body= 'your password Reset Otp is'.$otp;
   if( $mail->send()){
    return true;
   }
   else{
    return false;
   }    
}
