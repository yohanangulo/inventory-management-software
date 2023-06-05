<?php

session_start();

if (!isset($_SESSION['new_user_data'])) exit;
$email = $_SESSION['new_user_data']['email'];
$name = $_SESSION['new_user_data']['name'];


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  //Server settings
  $mail->SMTPDebug = 0;                                       //Enable verbose debug output
  $mail->isSMTP();                                            //Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  $mail->Username   = 'anguloyohan98@gmail.com';                     //SMTP username
  $mail->Password   = '';                               //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
  $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  //Recipients
  $mail->setFrom('anguloyohan98@gmail.com');
  $mail->addAddress("$email");     //Add a recipient

  //Content
  $mail->isHTML(true);                                  //Set email format to HTML
  $mail->Subject = 'Welcome to our inventory management system!';
  $mail->Body    =
  "Dear $name,<br><br>
  
  Welcome to Inventory Management System! We are excited to have you as our user and look forward to help you make your inventory management process easier";

  $mail->send();

} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// unset data
unset($_SESSION['new_user_data']);
?>