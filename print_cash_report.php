<?php

require_once "autoload.php";
require_once "num2text.php";

$end_date = $_GET['end_date'];
$apteka_id = $_GET['apteka_id'];
$cash_report_type = $_GET['cash_report_type'];

if($cash_report_type == 1) {
    $report_name = 'Звiт касира';
}else{
    $report_name = 'Вкладний аркуш касира';
}

$requisite = new Requisites($apteka_id);
$req = $requisite->result_data;
//var_dump($req);

$zav_id = $req[0]['zav_id'];

$people = new GetPeopleById($zav_id);
$zav = $people->result_data;
$fio = $zav[0]['full_name'];

$date_full = new FullDateName($end_date);
$date_pr = $date_full->result_data;

$get_orders = new SearchOrders($end_date, $end_date, $apteka_id);
$orders = $get_orders->result_data;
//var_dump($orders);
if (empty($orders)){
    exit("За данный период нет ордеров!!!");
}

$max_num = null;
//var_dump($max_num);
$last_cash_report_number = (int) $req[0]['last_cash_report_number'];

if(!empty($orders)) {
    $max_num = (int)max(array_column($orders, 'last_cash_report_number'));
    //var_dump($max_num);
}
if ($max_num == null) {
    $max_num = $last_cash_report_number;
    $max_num ++;
}
//var_dump($max_num);

$method = 'update_last_cash_report_nuber';
$rows = [];
$result_p = 0;
$result_r = 0;
$count_p = 0;
$count_r = 0;

foreach ($orders as $order) {
    $element = ['id'  => $order['id'],
                'num' => $max_num];

    $sum_pr = null;
    $sum_r = null;
    if($order['order_type'] == 'Приходный ордер'){
        $sum_pr = $order['sum'];
        $num_r = '702.1';
    }else{
        $sum_r = $order['sum'];
        $num_r = '333.1';
    }

    $row = ['num' => $order['num'],
            'fio' => $fio,
            'num_r' => $num_r,
            'sum_pr' => $sum_pr,
            'sum_r' => $sum_r];
    if ($sum_pr){
        $count_p++;
    }
    if ($sum_r){
        $count_r++;
    }
    $result_p += $sum_pr;
    $result_r += $sum_r;

    array_push($rows, $row);

    $save = new SaveToDBOrders($element, $method);
}
//var_dump($rows);

if ($last_cash_report_number < $max_num) {
    $apteka_to_update = ['id' => $apteka_id,
                        'num' => $max_num];
    $save = new SaveToDBApteka($apteka_to_update, $method);
}

$temp_date = date("Y-m-d", strtotime("$end_date -1 day"));

$saldo = new CashSaldo();

$saldo_chek = $saldo->chekSetSaldo($apteka_id);
//var_dump($saldo_chek);
if($saldo_chek[0]['count'] == 0){
    $saldo->setSaldo($apteka_id, $temp_date, 0, 'new', 0);
}

$saldo_start = $saldo->getSaldo($apteka_id, $temp_date);
//var_dump($saldo_start);
while(empty($saldo_start)){
    $temp_date = date("Y-m-d", strtotime("$temp_date -1 day"));
    $saldo_start = $saldo->getSaldo($apteka_id, $temp_date);
}

$saldo_start = $saldo_start[0]['saldo'];
$result_p = number_format($result_p,2,'.','');
$result_r = number_format($result_r,2,'.','');
$saldo_end = $saldo_start + $result_p - $result_r;

if($count_p == 0){
    $count_p_str = 'ноль';
}else {
    $count_p_str = num2text_ua($count_p);
}
if($count_r == 0){
    $count_r_str = 'ноль';
}else {
    $count_r_str = num2text_ua($count_r);
}

$saldo = new CashSaldo();
$saldo_tec = $saldo->getSaldo($apteka_id, $end_date);
//var_dump($saldo_tec);
if (empty($saldo_tec)){
    $method = 'new';
    $id = 0;
}else{
    $method = 'update';
    $id = $saldo_tec[0]['id'];
}
$saldo->setSaldo($apteka_id, $end_date, $saldo_end, $method, $id);

require_once './templates_print/cash_report.htm';