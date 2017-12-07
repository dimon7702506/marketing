<?php

session_start();

require_once "./function.php";

if (!is_user_logged_in()) {
    //показать форму ввода логин-пароль
    $errors = [];

    if (isset($_POST['submit_login'])) {
        $login = $_POST['inputLogin'] ?? $errors['incorrect'] = 'Incorrect login';
        $password = $_POST['inputPassword'] ?? $errors['incorrect'] = 'Incorrect password';

        if (empty($errors)) {

            $account = validation($login, $password);
            $user_id = 0;
            $user_name = '';

            foreach ($account as $key =>$val) {
                $user_id = (int) $val['id'];
                $user_name = $val['name'];
            }

            if ($user_id > 0) {
                log_in($user_id, $login, $user_name);
                header('location: index.php');
            }else{
                echo "fgfdgdfgd";
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
    include "./menu.html";
}