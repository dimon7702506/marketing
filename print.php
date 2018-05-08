<?php

require_once "autoload.php";
require_once "function.php";

$order_type = $_GET['order_type'];
$okpo = $_GET['okpo'];
$firm = $_GET['firm'];
$num = $_GET['num'];
$date = $_GET['date'];
$sum = $_GET['sum'];
$fio = $_GET['fio'];
$apteka = $_GET['apteka'];

$sum_text = ucfirst(num2text_ua($sum));

$date_full = new FullDateName($date);
$date_pr = $date_full->result_data;

if ($order_type == 'Приходный ордер') {
    require_once './templates_print/p_order.htm';
}else{
    /*require_once './templates_print/r_order.htm';*/
}