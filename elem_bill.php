<?php

require_once "./function.php";
require_once "autoload.php";

is_user_logged_in();

$date_bill = '';
$date_get = '';
$apteka_id = 0;
$apteka = '';

$bill_1000 = 0;
$bill_500 = 0;
$bill_200 = 0;
$bill_100 = 0;
$bill_50 = 0;
$bill_20 = 0;
$bill_10 = 0;
$bill_5 = 0;
$bill_2 = 0;
$bill_1 = 0;

$errors = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $find = new GetData('bill',$id, 'ID', 'elem');
    $results = $find->result_data;

    //var_dump_($results);
    foreach ($results as $result){
        $date_bill = $result['date_bill'];
        $date_get = $result['date_get'];
        $apteka_id = $result['apteka_id'];
        $apteka = $result['apteka'];

        $bill_1000 = $result['bill_1000'];
        $bill_500 = $result['bill_500'];
        $bill_200 = $result['bill_200'];
        $bill_100 = $result['bill_100'];
        $bill_10 = $result['bill_10'];
        $bill_5 = $result['bill_5'];
        $bill_2 = $result['bill_2'];
        $bill_1 = $result['bill_1'];

        $sum_1000 = $bill_1000 * 1000;
        $sum_500 = $bill_500 * 500;
        $sum_200 = $bill_200 * 200;
        $sum_100 = $bill_100 * 100;
        $sum_50 = $bill_50 * 50;
        $sum_20 = $bill_20 * 20;
        $sum_10 = $bill_10 * 10;
        $sum_5 = $bill_5 * 5;
        $sum_2 = $bill_2 * 2;
        $sum_1 = $bill_1;

        $sum = $sum_1000 + $sum_500 + $sum_200 + $sum_100 + $sum_50 + $sum_20 + $sum_10 + $sum_5 + $sum_2 + $sum_1;
    }

    if($date_bill == '') {$date_bill = date("Y-m-d", strtotime('yesterday'));}
    if($apteka_id == '') {$apteka_id = get_apteka_id();}
    if ($apteka == '') {
        $new_apteka = new GetData('podr',  get_apteka_id(), 'id', "elem");
        $new_results = $new_apteka->result_data;
        foreach ($new_results as $new_result) {$apteka = $new_result['apteka'];}
    }

    $find_list = new GetData('podr','','', 'list');
    $lists = $find_list->result_data;
}

if (isset($_POST['save'])){

    if (isset($_POST['date_bill'])) {
        $check = new CheckFields('Дата создания', 'date', 0,0 , 0, $_POST['date_bill'], 'required');
        $errors .= $check->error;
        $date_bill = $check->value;
    }
    if (isset($_POST['date_get'])) {
        $check = new CheckFields('Дата прихода', 'date', 0,0 , 0, $_POST['date_get'], 'required');
        $errors .= $check->error;
        $date_get = $check->value;
    }
    if (isset($_POST['bill_1000'])) {
        $check = new CheckFields('1000', 'number', 0,100000 , 0, $_POST['bill_1000'], 'required');
        $errors .= $check->error;
        $bill_1000 = $check->value;
    }
    if (isset($_POST['bill_500'])) {
        $check = new CheckFields('500', 'number', 0,1000000 , 0, $_POST['bill_500'], 'required');
        $errors .= $check->error;
        $bill_500 = $check->value;
    }
    if (isset($_POST['bill_200'])) {
        $check = new CheckFields('200', 'number', 0,1000000 , 0, $_POST['bill_200'], 'required');
        $errors .= $check->error;
        $bill_200 = $check->value;
    }
    if (isset($_POST['bill_100'])) {
        $check = new CheckFields('100', 'number', 0,1000000 , 0, $_POST['bill_100'], 'required');
        $errors .= $check->error;
        $bill_100 = $check->value;
    }
    if (isset($_POST['bill_50'])) {
        $check = new CheckFields('50', 'number', 0,1000000 , 0, $_POST['bill_50'], 'required');
        $errors .= $check->error;
        $bill_50 = $check->value;
    }
    if (isset($_POST['bill_20'])) {
        $check = new CheckFields('20', 'number', 0,1000000 , 0, $_POST['bill_20'], 'required');
        $errors .= $check->error;
        $bill_20 = $check->value;
    }
    if (isset($_POST['bill_10'])) {
        $check = new CheckFields('10', 'number', 0,1000000 , 0, $_POST['bill_10'], 'required');
        $errors .= $check->error;
        $bill_10 = $check->value;
    }
    if (isset($_POST['bill_5'])) {
        $check = new CheckFields('5', 'number', 0,1000000 , 0, $_POST['bill_5'], 'required');
        $errors .= $check->error;
        $bill_5 = $check->value;
    }
    if (isset($_POST['bill_2'])) {
        $check = new CheckFields('5', 'number', 0,1000000 , 0, $_POST['bill_2'], 'required');
        $errors .= $check->error;
        $bill_2 = $check->value;
    }
    if (isset($_POST['bill_1'])) {
        $check = new CheckFields('5', 'number', 0,1000000 , 0, $_POST['bill_1'], 'required');
        $errors .= $check->error;
        $bill_1 = $check->value;
    }

    //var_dump_($new_results);
    //var_dump_($unique_key);
    //var_dump_($errors);

    if (empty($errors)){
        $element[] = '';
        $element = ['id'=>$id,
                    'date_bill'=>$date_bill,
                    'date_get'=>$date_get,
                    'apteka_id'=>$apteka_id,
                    'bill_1000'=>(int) $bill_1000,
                    'bill_500'=>(int) $bill_500,
                    'bill_200'=>(int) $bill_200,
                    'bill_100'=>(int) $bill_100,
                    'bill_50'=>(int) $bill_50,
                    'bill_20'=>(int) $bill_20,
                    'bill_10'=>(int) $bill_10,
                    'bill_5'=>(int) $bill_5,
                    'bill_2'=>(int) $bill_2,
                    'bill_1'=>(int) $bill_1,
                    'sum'=>(int) $sum];

        if ($id == 0) {$method = 'new';
        }else {$method = 'update';}

        $save = new SetData('bill', $element, $method);

        if ($method == 'new') {$id = $save->result;}
        header("location: ./elem_bill.php?id=$id");
    }
}

if (isset($_POST['close'])) {
    if (isset($_COOKIE['text_search']) && (isset($_COOKIE['field_search']))){
        $str_search = './spr.php?search='. $_COOKIE['text_search'] . '&field_search=' . $_COOKIE['field_search'] . '&submit_search=search';
    }else{
        if ($sp_type == 'marketing') {
            $str_search = './spr.php?submit_search';
        }else {
            $str_search = './spr.php';
        }
    }
    header("location: $str_search");
}

require_once "./elem_bill.html";