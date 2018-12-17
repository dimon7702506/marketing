<?php

require_once "./function.php";
require_once "autoload.php";

if (isset($_GET['submit_search'])) {
    $text_search = $_GET['search'];
    $field_search = $_GET['field_search'];
    $field = '';

    $find = new ShowMNN($text_search, $field_search, $field);
    //var_dump($find->result_data);
    $mnns = $find->result_data;
    $count = count($mnns);
    setcookie("text_search", $text_search);
    setcookie("field_search", $field_search);
}

if (isset($_GET['submit_new'])) {
    header("location: ./element_mnn.php?id=0");
}

require_once "./mnn.html";