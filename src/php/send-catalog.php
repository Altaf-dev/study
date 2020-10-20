<?php
// Файлы phpmailer
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';
// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $msg = "ok";
    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    // Настройки вашей почты
    $mail->Host       = 'smtp.yandex.kz'; // SMTP сервера GMAIL
    $mail->Username   = 'sendmailsoft@yandex.kz'; // Логин на почте
    $mail->Password   = 'mbufhingwneiutfc'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('sendmailsoft@yandex.ru', 'Evgenyi Konovalov'); // Адрес самой почты и имя отправителя
    // Получатель письма
    $mail->addAddress($email);
    // Прикрипление файлов к письму
    $mail->addAttachment("../uploads/catalog.pdf");
    // -----------------------
    // Само письмо
    // -----------------------
    $mail->isHTML(true);

    $mail->Subject = 'Каталог продукции Leoteck';
    $mail->Body    = "<p>Уважаемый(-ая),<strong> $name,</strong> благодарим вас за обращение в нашу компанию.</p>
<p>Во вложении актуальный каталог.</p>
<p>Если у вас возникли какие-либо вопросы или Вы хотите сделать заказ, то Вы можете связаться с нами по телефону. </p>
<p>+7 777 777 77 77 </p>
<p>__</p>
<p>С уважением, ТОО Leoteck</p>
<p>info@leoteck.kz</p>
<a href='http://leoteck.kz'>www.leoteck.kz</a>";
// Проверяем отравленность сообщения
    if ($mail->send()) {
        echo "$msg";
    } else {
        echo "Сообщение не было отправлено. Неверно указаны настройки вашей почты";
    }
} catch (Exception $e) {
    echo "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}