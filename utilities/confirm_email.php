<?php

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function confirmEmail($email,$username,$token,$db,$query,$pass_reset){

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'yourusername';                     //SMTP username
    $mail->Password   = 'yourpassword';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('igormanolescu@gmail.com', 'Cibotarescu Igor CEO DATABASE');
    $mail->addAddress($email, $username);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('igormanolescu@gmail.com', 'ONLY FOR Information');


    //Attachments
    $mail->addAttachment('./welcome.jpg');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'DATABSE REGISTRATION AND EMAIL VALIDAITON';
    if($pass_reset==1){
        $mail->Body    = "Your fresh password: $token";
        $mail->AltBody = "Your fresh password: $token";
    
    }else{
    $mail->Body    = "Go to the link to activate your account <a href='http://localhost/regna2/php/verify.php?token=$token'>Verify</a>";
    $mail->AltBody = "Go to the link to activate your account <a href='http://localhost/regna2/php/verify.php?token=$token'>Verify</a>";
    }


    $mail->send();
    mysqli_query($db,$query);
    if($pass_reset==1){
        echo "Your password was succesfully reseted!";
        echo "<br>";
        echo 'Verify your email account for your new password.You may want to check the spam.';

    }elseif($pass_reset==0){
        echo 'You have successfully registerd,verify your email account for confirmation code.Check the spam please.';
    }
} catch (Exception $e) {
    echo "Could not send verification code to your email.{$mail->ErrorInfo}";
}
}


function sendMessage($email,$name,$subject,$message){

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'igormanolescu@gmail.com';                     //SMTP username
        $mail->Password   = 'mamika4xd';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom($email,$name );
        $mail->addAddress('igormanolescu@gmail.com', 'Cibotarescu Igor CEO DATABASE');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo($email, 'ONLY FOR Information');
    
    
        // //Attachments
        // $mail->addAttachment('./welcome.jpg');         //Add attachments
        // // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    =$message;
        $mail->AltBody =$message;
        $mail->send();
        
    } catch (Exception $e) {
        echo "Could not send verification code to your email.{$mail->ErrorInfo}";
    }
    }

?>
