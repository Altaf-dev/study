<?php
// Файлы phpmailer
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';
// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$product = $_POST['product'];
$special = $_POST['special'];
$subject = $_POST['subject'];
$page = $_POST['page'];
$utm_source = $_POST['utm_source'];
$utm_medium = $_POST['utm_medium'];
$utm_campaign = $_POST['utm_campaign'];
$utm_content = $_POST['utm_content'];
$utm_term = $_POST['utm_term'];
$yclid = $_POST['yclid'];
$gclid = $_POST['gclid'];
$pm_position= $_POST['pm_position'];
$keyword = $_POST['keyword'];
$clientid = $_POST['clientid'];
$googlecid = $_POST['googlecid'];

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
    $mail->addAddress('maxim@domdm.kz');
//    $mail->addAddress('youremail@gmail.com'); // Ещё один, если нужен
    // Прикрипление файлов к письму
if (!empty($_FILES['myfile']['name'][0])) {
    for ($ct = 0; $ct < count($_FILES['myfile']['tmp_name']); $ct++) {
        $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['myfile']['name'][$ct]));
        $filename = $_FILES['myfile']['name'][$ct];
        if (move_uploaded_file($_FILES['myfile']['tmp_name'][$ct], $uploadfile)) {
            $mail->addAttachment($uploadfile, $filename);
        } else {
            $msg .= 'Неудалось прикрепить файл ' . $uploadfile;
        }
    }
}
        // -----------------------
        // Само письмо
        // -----------------------
        $mail->isHTML(true);
    
        $mail->Subject = $subject;
        $mail->Body    = "<b>Имя:</b> $name <br><br>
        <b>Почта:</b> $email<br><br>
        <b>Телефон:</b> $phone <br>
        $product
        $special <br><br>
        ---Служебная информация--- <br>
        <b>Страница: </b> $page <br>
        <b>UTM_SOURCE: </b> $utm_source <br>
        <b>UTM_MEDIUM: </b> $utm_medium <br>
        <b>UTM_CAMPAIGN: </b> $utm_campaign <br>
        <b>UTM_CONTENT: </b> $utm_content <br>
        <b>UTM_TERM: </b> $utm_term <br>
        <b>Позиция в выдаче: </b> $pm_position <br>
        <b>Запрос клиента: </b> $keyword <br>
        <b>Яндекс Клиент ID: </b> $yclid <br>
        <b>Google Клиент ID: </b> $gclid <br>
        <b>Клиент ID Google Adwords </b> $googlecid <br>
        <b>Клиент ID Яндекс Метрики </b> $clientid <br>";
// Проверяем отравленность сообщения
if ($mail->send()) {
    echo "$msg";
} else {
echo "Сообщение не было отправлено. Неверно указаны настройки вашей почты";
}
} catch (Exception $e) {
    echo "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}