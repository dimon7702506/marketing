<?php

require_once "./function.php";
require_once "autoload.php";

$text_search = '';
$field_search = '';
$find = new ShowMarketings1($text_search, $field_search);
$marketings = $find->result_data;
//var_dump($marketings);

if (isset($_GET['submit_new'])) {
    header("location: ./element_marketing.php?id=0");
}

require_once "./marketings.html";