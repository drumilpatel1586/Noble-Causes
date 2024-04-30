<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

require('../connection.php');
$sql43 = "SELECT `name`,`email` FROM `user_login` WHERE `user_login`.`user_id`='$user_id'";
$result43 = mysqli_query($conn,$sql43);
$row43 = mysqli_fetch_array($result43);
$user_name = $row43['name'];
$email = $row43['email'];
$body =  'Dear '.$user_name.',
<br>
<p>This is a reminder that the deadline for returning the book is '.$deadline_date.'. You must to return the book before '.$deadline_date.' </p>
<br>
<p>Thank you.</p>
'; 
$subject = 'Delivered Book Deadline';

try{
    
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'noblecausesamd@gmail.com';
    $mail->Password   = 'nuou iaom zqyo svzp';
    $mail->SMTPSecure = 'tsl';                       
    $mail->Port       = 587;                       
    $mail->setFrom('noblecausesamd@gmail.com');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail -> send();
    echo 'mail send';
} catch (Exception $e) {
    echo 'Email sending failed. Error: ', $mail->ErrorInfo;
}
?>
