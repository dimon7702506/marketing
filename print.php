<?php

require_once "autoload.php";
require_once "function.php";

$order_type = $_GET['order_type'];
$okpo = $_GET['okpo'];
$firm = $_GET['firm'];
$num = $_GET['num'];
$date = $_GET['date'];
$sum = $_GET['sum'];
$zav_id = $_GET['zav_id'];
$apteka = $_GET['apteka'];

$sum_text = ucfirst(sum2text_ua($sum));

$people = new GetPeopleById($zav_id);
$zav = $people->result_data;
//var_dump($zav);
$fio = $zav[0]['full_name'];

$date_full = new FullDateName($date);
$date_pr = $date_full->result_data;

$date_short = date('d.m.Y', strtotime($date));

if ($order_type == 'Приходный ордер') {
    require_once './templates_print/p_order.htm';
}elseif($order_type == 'Расходный ордер БАНК'){
    $extradite = 'здана готiвка в банк';
    $base = 'зарахування грошових коштiв на поточний рахунок банку';
    $got = '';
    $pasport = '';
    require_once './templates_print/r_order.html';
}elseif($order_type == 'Расходный ордер ОФИС'){
    $extradite = $fio;
    $base = 'здана готівка в центральну касу';
    $got = $sum_text;
    $pasport = 'паспортом громадянина України - серія ' . $zav[0]['passport_seria'] . ' №' . $zav[0]['passport_num'] .
        ' від ' . date('d.m.Y',strtotime($zav[0]['pasport_get_date'])) . ' ' . $zav[0]['passport_get'];
    require_once './templates_print/r_order.html';
}