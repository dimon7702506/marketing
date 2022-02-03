<?php

require_once "./function.php";
require_once "autoload.php";

is_user_logged_in();

$errors = '';
$date_cash = '';
$apteka_id = '';
$cash_k1 = '';
$cash_k2 = '';
$cash_k3 = '';
$card_k1 = '';
$card_k2 = '';
$card_k3 = '';
$collection_k1 = '';
$collection_k2 = '';
$collection_k3 = '';
$bank = '';
$number_of_checks = '';
$discount_k1 = '';
$discount_k2 = '';
$discount_k3 = '';
$increment_k1 = '';
$increment_k2 = '';
$increment_k3 = '';
$round_k1 = '';
$round_k2 = '';
$round_k3 = '';
$turnover_0_k1 = '';
$turnover_0_k2 = '';
$turnover_0_k3 = '';
$turnover_7_k1 = '';
$turnover_7_k2 = '';
$turnover_7_k3 = '';
$turnover_20_k1 = '';
$turnover_20_k2 = '';
$turnover_20_k3 = '';
$return_0_k1 = '';
$return_0_k2 = '';
$return_0_k3 = '';
$return_7_k1 = '';
$return_7_k2 = '';
$return_7_k3 = '';
$return_20_k1 = '';
$return_20_k2 = '';
$return_20_k3 = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $find = new GetData('cash_day',$id, 'ID', 'elem');
    $results = $find->result_data;

    //var_dump_($results);

    foreach ($results as $result){
        $date_cash = $result['date_cash'];
        $apteka_id = $result['apteka_id'];
        $apteka = $result['apteka'];
        $cash_k1 = $result['cash_k1'];
        $cash_k2 = $result['cash_k2'];
        $cash_k3 = $result['cash_k3'];
        $card_k1 = $result['card_k1'];
        $card_k2 = $result['card_k2'];
        $card_k3 = $result['card_k3'];
        $collection_k1 = $result['collection_k1'];
        $collection_k2 = $result['collection_k2'];
        $collection_k3 = $result['collection_k3'];
        $bank = $result['bank'];
        $number_of_checks = $result['number_of_checks'];
        $discount_k1 = $result['discount_k1'];
        $discount_k2 = $result['discount_k2'];
        $discount_k3 = $result['discount_k3'];
        $increment_k1 = $result['increment_k1'];
        $increment_k2 = $result['increment_k2'];
        $increment_k3 = $result['increment_k3'];
        $round_k1 = $result['round_k1'];
        $round_k2 = $result['round_k2'];
        $round_k3 = $result['round_k3'];
        $turnover_0_k1 = $result['turnover_0_k1'];
        $turnover_0_k2 = $result['turnover_0_k2'];
        $turnover_0_k3 = $result['turnover_0_k3'];
        $turnover_7_k1 = $result['turnover_7_k1'];
        $turnover_7_k2 = $result['turnover_7_k2'];
        $turnover_7_k3 = $result['turnover_7_k3'];
        $turnover_20_k1 = $result['turnover_20_k1'];
        $turnover_20_k2 = $result['turnover_20_k2'];
        $turnover_20_k3 = $result['turnover_20_k3'];
        $return_0_k1 = $result['return_0_k1'];
        $return_0_k2 = $result['return_0_k2'];
        $return_0_k3 = $result['return_0_k3'];
        $return_7_k1 = $result['return_7_k1'];
        $return_7_k2 = $result['return_7_k2'];
        $return_7_k3 = $result['return_7_k3'];
        $return_20_k1 = $result['return_20_k1'];
        $return_20_k2 = $result['return_20_k2'];
        $return_20_k3 = $result['return_20_k3'];
    }
}

if (isset($_POST['save']) || isset($_POST['copy'])){

    if (isset($_POST['date_cash'])) {
        $check = new CheckFields('Дата', 'date', 0,0 , 0, $_POST['date_cash'], 'required');
        $errors .= $check->value;
    }
    if (isset($_POST['apteka_id'])) {
        $check = new CheckFields('Аптека', 'number', 1,999 , 0, $_POST['apteka_id'], 'required');
        $errors .= $check->value;
    }
    if (isset($_POST['cash_k1'])) {
        $check = new CheckFields('Выручка касса 1', 'number', 0,9999999.99 , 10, $_POST['cash_k1'], 'required');
        $errors .= $check->value;
    }
    if (isset($_POST['cash_k2'])) {
        $check = new CheckFields('Выручка касса 2', 'number', 0,9999999.99 , 10, $_POST['cash_k2'], 'required');
        $errors .= $check->value;
    }


    if (empty($errors)){
        $element = ['id'=>$id,
                    'morion_id'=>(int) $morion_id,
                    'name'=>trim($name),
                    'producer'=>trim($producer),
                    'barcode'=>$barcode,
                    'tnved'=>$tnved,
                    'nac'=>(int) $nac,
                    'tax'=>(int) $tax,
                    'bonus'=>(float)$bonus,
                    'marketing'=>$marketing,
                    'gran_price'=>(float) $gran_price,
                    'sum_com'=>(float) $sum_com,
                    'mnn'=>$mnn,
                    'form_prod'=>$form_prod,
                    'doza'=>trim($doza),
                    'name_torg'=>$name_torg,
                    'amount_in_a_package'=>(int) $amount_in_a_package,
                    'project_dl'=>$project_dl,
                    'internet_sales'=>$internet_sales,
                    'internet_price'=>(int) $internet_price,
                    'fix_price'=>(float) $fix_price,
                    'covid'=>$covid,
                    'insulin'=>$insulin,
                    'covid_protokol'=>$covid_protokol,
                    'baby_box'=>$baby_box,
                    'last_modify_author_id'=>(int) get_user_id()];

        if ($id == 0) {$method = 'new';
        }else {$method = 'update';}

        if (isset($_POST['copy'])){
            $element['id'] = 0;
            $method = 'new';
        }

        //var_dump($element);
        $save = new SaveToDB($element, $method);

        if ($method == 'new') {$id = $save->result;}
        header("location: ./element.php?id=$id");
    }
}

if (isset($_POST['close'])) {

    if (isset($_COOKIE['text_search']) && (isset($_COOKIE['field_search']))){
        $str_search = './names.php?search='. $_COOKIE['text_search'] . '&field_search=' . $_COOKIE['field_search'] . '&submit_search=search';
    }else{
        $str_search = './names.php';
    }
    //var_dump($str_search);
    header("location: $str_search");
}

require_once "./elem_cash.html";