<?php

require_once "./function.php";
require_once "autoload.php";

session_start();
is_user_logged_in();

$start_date = date("Y-m-01");
$end_date = date("Y-m-d");
$apteka_id = $_SESSION['apteka_id'];

if (isset($_GET['submit_search'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    $find = new SearchOrders($start_date, $end_date, $apteka_id);
    //var_dump($find->result_data);
    $orders = $find->result_data;
    $count = count($orders);
    setcookie("start_date", $start_date);
    setcookie("end_date", $end_date);
}

if (isset($_GET['new_order'])) {
    header("location: ./order.php?id=0");
}

if (isset($_GET['cash_report'])) {
    $end_date = $_GET['end_date'];
    $str = "./print_cash_report.php?end_date=" . $end_date . "&apteka_id=" . $apteka_id . "&cash_report_type=1";
    header("location: $str");
}

if (isset($_GET['cash_report1'])) {
    $end_date = $_GET['end_date'];
    $str = "./print_cash_report.php?end_date=" . $end_date . "&apteka_id=" . $apteka_id . "&cash_report_type=2";
    header("location: $str");
}

require_once "./orders.html";