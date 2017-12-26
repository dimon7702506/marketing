<?php

require_once "./function.php";
require_once "autoload.php";

if (isset($_POST['submit_search'])) {
    $text_search = $_POST['search'];
    $field_search = $_POST['field_search'];
    $field = '';

    $find = new Search($text_search, $field_search, $field);
    //var_dump($find->result_data);
    $nomens = $find->result_data;
    $count = count($nomens);
}

if (isset($_POST['submit_new'])) {
    header("location: ./element.php?id=0");
}

require_once "./names.html";