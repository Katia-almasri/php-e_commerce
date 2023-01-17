<?php
     
    if (isset($_post["submit"]))
    {
        echo "string";
         require "php-mailer-master\PHPMailerAutoload.php";

         $mail = new PHPMailer;
         $sender = "ecomerce.sy@gmail.com";

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = $sender;
$mail->Password = 'ecomerce123';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom($sender, 'Mailer');
$mail->addAddress($_post["receiver"]);  

$file_name = $_FILES["file"]["name"];
move_uploaded_file($_FILES["file"]["tmp_name"], $file_name);   


$mail->addAttachment($file_name);
$mail->isHTML(true);

$mail->Subject = $_post["subject"];
$mail->Body    = $_post["message"];

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
    }
?>


<form method="POST" enctype="multipart/form-data"  >
    <p>
    Send to:
    <input type="text" name="receiver" id="reciever">
    </p>
 
    <p>
    Subject:
    <input type="text" name="subject" id="subject">
    </p>
 
    <p>
    Message:
    <textarea name="message" id="message"></textarea>
    </p>
 
    <p>
    Select file:
    <input type="file" name="file" id="file">
    </p>
 
    <input type="submit" name="submit" id="submit">
</form>

