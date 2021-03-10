<?php

require_once "./function.php";
require_once "autoload.php";

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
        $allowedfileExtensions = array('xls');

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
    $XlsFile = $dest_path;
    if ( $xls = SimpleXLS::parse($XlsFile) ) {
        $result = $xls->rows();
    } else {echo SimpleXLSX::parseError();    }
}
$_SESSION['message'] = $message;

foreach ($result as $key=>$value){
    if ($key == 1){continue};
    var_dump($value);
}