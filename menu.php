<?php

require_once "./function.php";

is_user_logged_in();

if ($_COOKIE['role_id'] == 1){
    include "./menu.html";
}else{
    include "./menu_apteka.html";
}