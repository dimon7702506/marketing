<?php

session_start();

require_once "./function.php";
require_once "autoload.php";

if (!is_user_logged_in()) {
    $errors = [];

    if (isset($_POST['submit_login'])) {
        $login = $_POST['inputLogin'] ?? $errors['incorrect'] = 'Incorrect login';
        $password = $_POST['inputPassword'] ?? $errors['incorrect'] = 'Incorrect password';

        if (empty($errors)) {
            $valid = new Validation($login, $password);

            if ($valid->user_id > 0) {
                log_in($valid->user_id, $login, $valid->user_name, $valid->user_role_id, $valid->apteka_id);
                header('location: index.php');
            }else{
                $errors['bad_login'] = 'Wrong password or user name!!!';
            }
        }
    }
    include "./login.html";

}else{
    if (!empty($_POST['log_out'])){
        log_out();
        header('location: ./index.php');
    }
    //include "./menu.html";
    include "./menu.php";
}