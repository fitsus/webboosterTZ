<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once('phpmailer/src/Exception.php');
require_once('phpmailer/src/PHPMailer.php');
require_once('phpmailer/src/SMTP.php');


$mail = new PHPMailer(true);

try {
    $mail->CharSet = 'utf-8';

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.mail.ru';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'fitsusus@mail.ru';                     //SMTP username
    $mail->Password   = 'nNbMYvGKQPMb6V1Z6WQw';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->isHTML(true);

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $comment = $_POST['comment'];
    $item1 = $_POST['airforce-high'];
    $item2 = $_POST['superstar'];
    $item3 = $_POST['off-white-white'];
    $item4 = $_POST['off-white-green'];

    $mail->setFrom('fitsusus@mail.ru'); // от кого будет уходить письмо?
    $mail->addAddress('fitsusus@gmail.com');     // Кому будет уходить письмо 

    $mail->Subject = 'Заявка с тестового сайта';
    $body = '<p><strong>' .$name. ' оставил заявку:</strong> <br>Его телефон: ' .$phone. ' <br>Состав заказа:</p>';
    $body .= '<p>';
    if($item1 == "on") {
        $body .= '<br>Nike Air Force High';
    }
    if($item2 == "on") {
        $body .= '<br>Adidas Superstar';
    }
    if($item3 == "on") {
        $body .= '<br>Nike x Off-White AirForce Low White';
    }
    if($item4 == "on") {
        $body .= '<br>Nike x Off-White AirForce Low Green';
    }
    $body .= '</p>';
    $body .= '<p>С комментарием: ' .$comment. '</p>';

    $mail->Body = $body;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>