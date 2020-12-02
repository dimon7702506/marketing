<?php

require_once "./function.php";
require_once "autoload.php";

is_user_logged_in();

if (isset($_GET['submit_search'])) {
    $text_search = $_GET['search'];
    $field_search = $_GET['field_search'];
    $field = '';

    $find = new SearchFromNames($text_search, $field_search, $field);
    $nomens = $find->result_data;
    //var_dump($nomens);
    $count = count($nomens);
    setcookie("text_search", $text_search);
    setcookie("field_search", $field_search);
}

if (isset($_GET['submit_new'])) {
    header("location: ./element.php?id=0");
}

require_once "./names.html";