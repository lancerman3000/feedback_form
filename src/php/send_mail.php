<?php
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

$title = "Новое обращение";
$body = "
<h2>Заренистрирован новый пользователь:</h2>
<b>Имя:</b> $customerName<br>
<b>Почта:</b> $customerEmail<br><br>
<b>Сообщение:</b><br>$customerMessage
";

$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    $mail->Host       = 'smtp.yandex.ru'; 
    $mail->Username   = 'random4dmin@yandex.ru';
    $mail->Password   = 'wvezxfzgrjqmvirb';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('random4dmin@yandex.ru', 'Random 4dmin');

    $mail->addAddress('random4dmin@yandex.ru');  

$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

session_start();

if ($mail->send()) { $_SESSION['email_send_status'] = '<div class="alert alert-success">Сообщение было отправлено на почту администратора.</dir>';
} 
else {
    $_SESSION['email_send_status'] = '<div class="alert alert-danger">Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}</div>';
}

} catch (Exception $e) {}