<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

require '../config/db_connection.php';

$sql43 = "SELECT `name`,`email` FROM `user_login` WHERE `user_login`.`user_id`='$user_id'";
$result43 = mysqli_query($conn, $sql43);
$row43 = mysqli_fetch_array($result43);
$user_name = $row43['name'];
$email = $row43['email'];



$body = 'Dear '.$user_name.',
<br>
<p>We hope this email finds you well.</p>
<p>This is a gentle reminder that you have missed the deadline for returning the book titled " '.$book_title.'" As per our records, the return date was  '.$deadline_date.'.</p>
<p>We kindly request that you return the book as soon as possible to avoid any late fees or penalties. If you have already returned the book, please disregard this message.</p>
<p>Thank you for your attention to this matter.</p>
<br>
<p>Best regards,</p>
<p>Noble Causes Team.</p>';
$subject = ' Missed Deadline for Returning Book';

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
