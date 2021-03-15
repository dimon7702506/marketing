<?php

require_once "./function.php";
require_once "autoload.php";

$result = [];
$emails = [];

is_user_logged_in();

if ($_COOKIE['role_id'] == 1){
    include "./menu.html";
}else{
    include "./menu_apteka.html";
}

$message = '';
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Загрузить')
{

    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
    {
        // get details of the uploaded file
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // sanitize file-name
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        // check if file has one of the following extensions
        $allowedfileExtensions = array('dbf');

        if (in_array($fileExtension, $allowedfileExtensions))
        {
            // directory in which the uploaded file will be moved
            $uploadFileDir = './uploaded_files/';

            $dest_path = $uploadFileDir . $newFileName;

            if(move_uploaded_file($fileTmpPath, $dest_path)){$message ='File is successfully uploaded.';}
            else{$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';}
        }
        else {$message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);}
    }else{
        $message = 'There is some error in the file upload. Please check the following error.<br>';
        $message .= 'Error:' . $_FILES['uploadedFile']['error'];
    }
    /*
    $XlsFile = $dest_path;
    if ( $xls = SimpleXLS::parse($XlsFile) ) {
        $result = $xls->rows();
    } else {echo SimpleXLS::parseError();    }
    */
    $db = dbase_open($dest_path, 2);
    if ($db) {
        $record_numbers = dbase_numrecords($db);
        for ($i = 1; $i <= $record_numbers; $i++) {
            $res = dbase_get_record_with_names($db, $i);
            array_push($result, $res);
        }
        dbase_close($db);
    }
    //var_dump($result);
}

$_SESSION['message'] = $message;

$k = 0;

foreach ($result as $key=>$value) {
    //var_dump($value);
    $find = new GetData('podr', $value['PRIMECH_'], 'id', 'elem');
    $results = $find->result_data;

    $find_recipient = new GetData('podr', $value['ID_POINT'], 'id', 'elem');
    $results_recipient = $find_recipient->result_data;

    $recipient = $results_recipient[0]['apteka'];
    //var_dump($results_recipient);
    $email = $results[0]['email'];
    $apt_name = $value['IZGOTOV_'];
    $apt_name = str_replace("~", "", $apt_name);

    $apt[$k] = ['apteka_id' => $value['PRIMECH_'],
        'apteka_name' => $apt_name,
        'name' => $value['PREPARAT'],
        'quantity' => $value['ZAKAZ'],
        'email' => $email,
        'recipient' => iconv("utf-8", "cp866", $recipient)];

    $emails[$k] = ['email' => $email,
                   'apteka_name' => $apt_name];
    $k += 1;
}
    //var_dump($emails);

    $emails_uniq = super_unique($emails,'email');
    //var_dump($emails_uniq);

foreach ($emails_uniq as $key => $e){
    //var_dump($e);

    $text = '<br>' . '<br>' . $e['apteka_name'].":";
    foreach ($apt as $a){
        if ($a['email'] !== $e['email']) {continue;}
        $text .= '<br>'.$a['name'] . "  - " . $a['quantity'] . " --> " . $a['recipient'];
    }

    $text_1251 = iconv("cp866", "Windows-1251", $text);
    $text_utf = iconv("cp866", "utf-8", $text);

    $sender = get_user_email();
    //$sender = 'dimon@falbi.kh.ua';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'mx1.mirohost.net';
    $mail->SMTPAuth = true;
    $mail->Username = $sender;
    $mail->Password = 'Ebuprofen';
    //$mail->SMTPSecure = false;
    $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
    $mail->Port = 587;
    $mail->setFrom($sender);
    $mail->addAddress($e['email']);
    $mail->addAddress($sender);
    // Письмо
    $mail->CharSet = 'Windows-1251';
    $mail->isHTML(true);
    $mail->Subject = 'Order'; // Заголовок письма
    $mail->Body = $text_1251; // Текст письма

    echo $text_utf;
    // Результат
    if(!$mail->send()) {
        echo "<h1 style='color: red'>Message could not be sent.</h1>";
        echo "<h3>Mailer Error: . $mail->ErrorInfo </h3>";
    }
    array_map('unlink', glob($dest_path));
}