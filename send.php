<?php

// Настройки
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'mx1.mirohost.net';
$mail->SMTPAuth = true;
$mail->Username = 'admin@falbi.kh.ua';
$mail->Password = 'Ebuprofen';
//$mail->SMTPSecure = false;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$mail->Port = 587;
$mail->setFrom('admin@falbi.kh.ua');
//$mail->addAddress('dimon@falbi.kh.ua');
//$mail->addAddress("synhro@falbi.kh.ua");
$mail->addAddress("synhro@passat.kh.ua");
// Прикрепление файлов
$mail->addAttachment('/var/www/marketing.com/out/names.csv', 'names.csv');
$mail->addAttachment('/var/www/marketing.com/out/marketings.csv', 'marketings.csv');

// Письмо
$mail->isHTML(true);
$mail->Subject = 'Synhronization'; // Заголовок письма
$mail->Body = 'Synhronization names and marketings'; // Текст письма
// Результат
if(!$mail->send()) {
    echo "<h1 style='color: red'>Message could not be sent.</h1>";
    echo "<h3>Mailer Error: . $mail->ErrorInfo </h3>";
} else {
    header("location: admin.html");
}
