<?php

require_once "./function.php";
require_once "autoload.php";

$text_search = '';
$find = new ShowMarketings($text_search);
$marketings = $find->result_data;
//var_dump($marketings);

if (isset($_GET['submit_new'])) {
    header("location: ./element_marketing.php?id=0");
}

require_once "./marketings.html";