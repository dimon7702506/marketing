<?php

require_once "autoload.php";

$okpo = $_GET['okpo'];
$firm = $_GET['firm'];
$num = $_GET['num'];
$date = $_GET['date'];

$date_full = new FullDateName($date);
$date_pr = $date_full->result_data;

//var_dump($date_pr);

require_once './templates_print/p_order.htm';