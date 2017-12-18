<?php

require_once "./function.php";
require_once "autoload.php";

if (isset($_POST['submit_search'])) {
    $text_search = $_POST['search'];
    $field_search = $_POST['field_search'];
    $field = '';

    $find = new Find($text_search, $field_search, $field);
    //var_dump($find->result_data);
    $nomens = $find->result_data;
    $count = count($nomens);
}

require_once "./names.html";