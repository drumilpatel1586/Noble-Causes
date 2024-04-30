<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

require('../user/connection.php');

$sql43 = "SELECT `name` FROM `user_login` WHERE `user_login`.`user_id`='$id'";
$result43 = mysqli_query($conn, $sql43);
$row43 = mysqli_fetch_array($result43);
$user_name = $row43['name'];

$body = 'Dear '.$user_name.',
<br>
<p>I hope this email finds you in good spirits.</p>
<p>I am writing to extend my heartfelt gratitude for your recent  donation to Noble Causes.</p>
<p>Your generosity in donation has touched our hearts deeply, and we cannot thank you enough for your kindness and support.</p>
<p>Your contribution will go a long way in providing nourishment and comfort to those in need within our community.</p>
<p>Best regards,</p>
<p>Noble Causes Team</p>';
$subject = 'Gratitude from Noble Causes';

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
