<?php

require_once "./function.php";
require_once "autoload.php";

session_start();

if (isset($_GET['submit_search'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $apteka_id = $_SESSION['apteka_id'];
    var_dump($apteka_id);

    $find = new SearchOrders($start_date, $end_date);
    //var_dump($find->result_data);
    $orders = $find->result_data;
    $count = count($orders);
    setcookie("start_date", $start_date);
    setcookie("end_date", $end_date);
}

if (isset($_GET['new_order'])) {
    header("location: ./order.php?id=0");
}

require_once "./orders.html";