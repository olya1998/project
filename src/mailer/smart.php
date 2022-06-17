<?php

 $name = $_POST['name'];
 $phone = $_POST['phone'];
 $email = $_POST['email'];

 //Import PHPMailer classes into the global namespace
 //These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

try {
    $phpmailer = new PHPMailer();
    $phpmailer->CharSet = 'utf-8';
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = '7e8efb2bef9e9b';
    $phpmailer->Password = '37ef5701877e3f'; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $phpmailer->setFrom('info@zhirobasinka.com', 'Admin');
    $phpmailer->addAddress($email, $name);     //Add a recipient

    //Content
    $phpmailer->isHTML(true);  //Set email format to HTML
    $phpmailer->Subject = 'Данные';
    $phpmailer->Body    = '
 		Пользователь оставил данные <br> 
 	Имя: ' . $name . ' <br>
 	Номер телефона: ' . $phone . '<br>
 	E-mail: ' . $email;

    $phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $phpmailer->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
}
