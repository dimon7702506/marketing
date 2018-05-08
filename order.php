<?php

require_once "autoload.php";

session_start();

$apteka_id = $_SESSION['apteka_id'];
$errors = '';
$order_t = '';
$date_doc = date("Y-m-d");
$firm_name = '';
$sum = 0;

$requisite = new Requisites($apteka_id);
$req = $requisite->result_data;
//var_dump($req);

$head = $req[0]['firma'] . ', ' . $req[0]['apteka'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $find = new SearchOrder($id);
    $orders = $find->result_data;
    //var_dump($orders);

    foreach ($orders as $nom){
        $order_t = $nom['order_type'];
        $date_doc = $nom['date'];
        $sum = $nom['sum'];
        $num = $nom['num'];
     }

    $orders_type = new ShowOrdersType();
    $order_type = $orders_type->result_data;
}

if (isset($_POST['save'])){

    $check = new CheckField('date_doc', $_POST['date_doc']);
    $date_doc = $check->value;
    $errors .= $check->error;

    $check = new CheckField('sum', $_POST['sum']);
    $sum = $check->value;
    $errors .= $check->error;

    $check = new CheckField('order_type', $_POST['order_type']);
    $order_type = $check->value;
    $errors .= $check->error;

    if (empty($errors)){

        $max_number = new SearchMaxOrdersNumber($apteka_id, $order_type);
        $max_num = $max_number->result_data;

        $num = ((int) $max_num[0]['mn']) + 1;

        $element = ['id'=>$id,
            'date'=>$date_doc,
            'order_type'=>$order_type,
            'apteka_id'=>$apteka_id,
            'num'=>$num,
            'sum'=>(float) $sum];

        if ($id == 0) {
            $method = 'new';
            //var_dump($element);
        }else {
            $method = 'update';
        }

        $save = new SaveToDBOrders($element, $method);

        if ($method == 'new') {
            $id = $save->result;
        }
        header("location: ./order.php?id=$id");
    }
}

if (isset($_POST['close'])) {
    if (isset($_COOKIE['start_date']) && (isset($_COOKIE['end_date']))){
        $str_search = './orders.php?start_date='. $_COOKIE['start_date'] . '&end_date=' . $_COOKIE['end_date'] . '&submit_search=search';
    }else{
        $str_search = './orders.php';
    }
    header("location: $str_search");
}

if (isset($_POST['print'])) {
    $str = './print.php?okpo='.$req[0]['okpo'].'&firm='.$req[0]['firma'].'&num='.$num.'&date='.$date_doc.'&sum='.$sum.
        '&fio='.$req[0]['zav'].'&apteka='.$req[0]['apteka'].'&order_type='.$order_t;
    header("location: $str");
}
require_once "./order.html";