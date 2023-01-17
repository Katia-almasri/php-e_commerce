<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';

if(isset($_POST['submit'])){
  $name    = $_POST['full-name'];
  $email   = $_POST['email'];
  $phone   = $_POST['phone-number'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  try{
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'marktech.syr@gmail.com';        // Gmail address which you want to send the email from
    $mail->Password   = 'syria16920';                    // Gmail address Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = '587';

    $mail->setFrom('marktech.syr@gmail.com');            // Gmail address which you used as SMTP server
    $mail->addAddress('marktech.syr@gmail.com');         // Email address where you want to receive emails

    $mail->isHTML(true);
    $mail->Subject = 'Message Received (Contact Page)';
    $mail->Body    = "<h3>Name: $name <br><br>Email: $email <br><br>Phone number: $phone <br><br>Subject: $subject <br><br>Message: <br>$message</h3>";

    $mail->send();
    $alert = '<div class="alert-success">
                 <span>Message Sent! Thank you for contacting us.<a href="../home.php">Return to home</a></span>
                </div>';
  } catch (Exception $e){
    $alert = '<div class="alert-error">
                <span>'.$e->getMessage().'</span>
              </div>';
  }

  echo $alert;
}
?>
