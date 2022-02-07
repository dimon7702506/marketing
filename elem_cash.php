<?php

require_once "./function.php";
require_once "autoload.php";

is_user_logged_in();

$errors = '';
$date_cash = '';
$apteka_id = 0;
$cash_k1 = 0;
$cash_k2 = 0;
$cash_k3 = 0;
$card_k1 = 0;
$card_k2 = 0;
$card_k3 = 0;
$collection_k1 = 0;
$collection_k2 = 0;
$collection_k3 = 0;
$bank = 0;
$number_of_checks = 0;
$discount_k1 = 0;
$discount_k2 = 0;
$discount_k3 = 0;
$increment_k1 = 0;
$increment_k2 = 0;
$increment_k3 = 0;
$round_k1 = 0;
$round_k2 = 0;
$round_k3 = 0;
$turnover_0_k1 = 0;
$turnover_0_k2 = 0;
$turnover_0_k3 = 0;
$turnover_7_k1 = 0;
$turnover_7_k2 = 0;
$turnover_7_k3 = 0;
$turnover_20_k1 = 0;
$turnover_20_k2 = 0;
$turnover_20_k3 = 0;
$return_0_k1 = 0;
$return_0_k2 = 0;
$return_0_k3 = 0;
$return_7_k1 = 0;
$return_7_k2 = 0;
$return_7_k3 = 0;
$return_20_k1 = 0;
$return_20_k2 = 0;
$return_20_k3 = 0;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $find = new GetData('cash_day',$id, 'ID', 'elem');
    $results = $find->result_data;

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
        $date_cash = $_POST['date_cash'];
    }
    if (isset($_POST['apteka_id'])) {
        $check = new CheckFields('Аптека', 'number', 1,999 , 0, $_POST['apteka_id'], 'required');
        $errors .= $check->value;
        $apteka_id = $_POST['apteka_id'];
    }
    if (isset($_POST['cash_k1'])) {
        $check = new CheckFields('Выручка касса 1', 'number', 0,9999999.99 , 10, $_POST['cash_k1'], '');
        $errors .= $check->value;
        $cash_k1 = $_POST['cash_k1'];
    }
    if (isset($_POST['cash_k2'])) {
        $check = new CheckFields('Выручка касса 2', 'number', 0,9999999.99 , 10, $_POST['cash_k2'], '');
        $errors .= $check->value;
        $cash_k2 = $_POST['cash_k2'];
    }
    if (isset($_POST['cash_k3'])) {
        $check = new CheckFields('Выручка касса 3', 'number', 0,9999999.99 , 10, $_POST['cash_k3'], '');
        $errors .= $check->value;
        $cash_k3 = $_POST['cash_k3'];
    }
    if (isset($_POST['card_k1'])) {
        $check = new CheckFields('Выручка касса 1', 'number', 0,9999999.99 , 10, $_POST['card_k1'], '');
        $errors .= $check->value;
        $card_k1 = $_POST['card_k1'];
    }
    if (isset($_POST['card_k2'])) {
        $check = new CheckFields('Выручка касса 2', 'number', 0,9999999.99 , 10, $_POST['card_k2'], '');
        $errors .= $check->value;
        $card_k2 = $_POST['card_k2'];
    }
    if (isset($_POST['card_k3'])) {
        $check = new CheckFields('Выручка касса 3', 'number', 0,9999999.99 , 10, $_POST['card_k3'], '');
        $errors .= $check->value;
        $card_k3 = $_POST['card_k3'];
    }
    if (isset($_POST['collection_k1'])) {
        $check = new CheckFields('Выручка касса 1', 'number', 0,9999999.99 , 10, $_POST['collection_k1'], '');
        $errors .= $check->value;
        $collection_k1 = $_POST['collection_k1'];
    }
    if (isset($_POST['collection_k2'])) {
        $check = new CheckFields('Выручка касса 2', 'number', 0,9999999.99 , 10, $_POST['collection_k2'], '');
        $errors .= $check->value;
        $collection_k2 = $_POST['collection_k2'];
    }
    if (isset($_POST['collection_k3'])) {
        $check = new CheckFields('Выручка касса 3', 'number', 0,9999999.99 , 10, $_POST['collection_k3'], '');
        $errors .= $check->value;
        $collection_k3 = $_POST['collection_k3'];
    }
    if (isset($_POST['bank'])) {
        $check = new CheckFields('Сдано в банк', 'number', 0,9999999.99 , 10, $_POST['bank'], '');
        $errors .= $check->value;
        $bank = $_POST['bank'];
    }
    if (isset($_POST['number_of_checks'])) {
        $check = new CheckFields('Количество чеков', 'number', 0,9999999.99 , 10, $_POST['number_of_checks'], '');
        $errors .= $check->value;
        $number_of_checks = $_POST['number_of_checks'];
    }
    if (isset($_POST['discount_k1'])) {
        $check = new CheckFields('Скидка касса 1', 'number', 0,9999999.99 , 10, $_POST['discount_k1'], '');
        $errors .= $check->value;
        $discount_k1 = $_POST['discount_k1'];
    }
    if (isset($_POST['discount_k2'])) {
        $check = new CheckFields('Скидка касса 2', 'number', 0,9999999.99 , 10, $_POST['discount_k2'], '');
        $errors .= $check->value;
        $discount_k2 = $_POST['discount_k2'];
    }
    if (isset($_POST['discount_k3'])) {
        $check = new CheckFields('Скидка касса 3', 'number', 0,9999999.99 , 10, $_POST['discount_k3'], '');
        $errors .= $check->value;
        $discount_k3 = $_POST['discount_k3'];
    }
    if (isset($_POST['increment_k1'])) {
        $check = new CheckFields('Скидка касса 1', 'number', 0,9999999.99 , 10, $_POST['increment_k1'], '');
        $errors .= $check->value;
        $increment_k1 = $_POST['increment_k1'];
    }
    if (isset($_POST['increment_k2'])) {
        $check = new CheckFields('Скидка касса 2', 'number', 0,9999999.99 , 10, $_POST['increment_k2'], '');
        $errors .= $check->value;
        $increment_k2 = $_POST['increment_k2'];
    }
    if (isset($_POST['increment_k3'])) {
        $check = new CheckFields('Скидка касса 3', 'number', 0,9999999.99 , 10, $_POST['increment_k3'], '');
        $errors .= $check->value;
        $increment_k3 = $_POST['increment_k3'];
    }
    if (isset($_POST['round_k1'])) {
        $check = new CheckFields('Скидка касса 1', 'number', 0,9999999.99 , 10, $_POST['round_k1'], '');
        $errors .= $check->value;
        $round_k1 = $_POST['round_k1'];
    }
    if (isset($_POST['round_k2'])) {
        $check = new CheckFields('Скидка касса 2', 'number', 0,9999999.99 , 10, $_POST['round_k2'], '');
        $errors .= $check->value;
        $round_k2 = $_POST['round_k2'];
    }
    if (isset($_POST['round_k3'])) {
        $check = new CheckFields('Скидка касса 3', 'number', 0,9999999.99 , 10, $_POST['round_k3'], '');
        $errors .= $check->value;
        $round_k3 = $_POST['round_k3'];
    }
    if (isset($_POST['turnover_0_k1'])) {
        $check = new CheckFields('Оборот касса 1', 'number', 0,9999999.99 , 10, $_POST['turnover_0_k1'], '');
        $errors .= $check->value;
        $turnover_0_k1 = $_POST['turnover_0_k1'];
    }
    if (isset($_POST['turnover_0_k2'])) {
        $check = new CheckFields('Оборот касса 2', 'number', 0,9999999.99 , 10, $_POST['turnover_0_k2'], '');
        $errors .= $check->value;
        $turnover_0_k2 = $_POST['turnover_0_k2'];
    }
    if (isset($_POST['turnover_0_k3'])) {
        $check = new CheckFields('Оборот касса 3', 'number', 0,9999999.99 , 10, $_POST['turnover_0_k3'], '');
        $errors .= $check->value;
        $turnover_0_k3 = $_POST['turnover_0_k3'];
    }
    if (isset($_POST['turnover_7_k1'])) {
        $check = new CheckFields('Оборот касса 1', 'number', 0,9999999.99 , 10, $_POST['turnover_7_k1'], '');
        $errors .= $check->value;
        $turnover_7_k1 = $_POST['turnover_7_k1'];
    }
    if (isset($_POST['turnover_7_k2'])) {
        $check = new CheckFields('Оборот касса 2', 'number', 0,9999999.99 , 10, $_POST['turnover_7_k2'], '');
        $errors .= $check->value;
        $turnover_7_k2 = $_POST['turnover_7_k2'];
    }
    if (isset($_POST['turnover_7_k3'])) {
        $check = new CheckFields('Оборот касса 3', 'number', 0,9999999.99 , 10, $_POST['turnover_7_k3'], '');
        $errors .= $check->value;
        $turnover_7_k3 = $_POST['turnover_7_k3'];
    }
    if (isset($_POST['turnover_20_k1'])) {
        $check = new CheckFields('Оборот касса 1', 'number', 0,9999999.99 , 10, $_POST['turnover_20_k1'], '');
        $errors .= $check->value;
        $turnover_20_k1 = $_POST['turnover_20_k1'];
    }
    if (isset($_POST['turnover_20_k2'])) {
        $check = new CheckFields('Оборот касса 2', 'number', 0,9999999.99 , 10, $_POST['turnover_20_k2'], '');
        $errors .= $check->value;
        $turnover_20_k2 = $_POST['turnover_20_k2'];
    }
    if (isset($_POST['turnover_20_k3'])) {
        $check = new CheckFields('Оборот касса 3', 'number', 0,9999999.99 , 10, $_POST['turnover_20_k3'], '');
        $errors .= $check->value;
        $turnover_20_k3 = $_POST['turnover_20_k3'];
    }
    if (isset($_POST['return_0_k1'])) {
        $check = new CheckFields('Возврат касса 1', 'number', 0,9999999.99 , 10, $_POST['return_0_k1'], '');
        $errors .= $check->value;
        $return_0_k1 = $_POST['return_0_k1'];
    }
    if (isset($_POST['return_0_k2'])) {
        $check = new CheckFields('Возврат касса 2', 'number', 0,9999999.99 , 10, $_POST['return_0_k2'], '');
        $errors .= $check->value;
        $return_0_k2 = $_POST['return_0_k2'];
    }
    if (isset($_POST['return_0_k3'])) {
        $check = new CheckFields('Возврат касса 3', 'number', 0,9999999.99 , 10, $_POST['return_0_k3'], '');
        $errors .= $check->value;
        $return_0_k3 = $_POST['return_0_k3'];
    }
    if (isset($_POST['return_7_k1'])) {
        $check = new CheckFields('Возврат касса 1', 'number', 0,9999999.99 , 10, $_POST['return_7_k1'], '');
        $errors .= $check->value;
        $return_7_k1 = $_POST['return_7_k1'];
    }
    if (isset($_POST['return_7_k2'])) {
        $check = new CheckFields('Возврат касса 2', 'number', 0,9999999.99 , 10, $_POST['return_7_k2'], '');
        $errors .= $check->value;
        $return_7_k2 = $_POST['return_7_k2'];
    }
    if (isset($_POST['return_7_k3'])) {
        $check = new CheckFields('Возврат касса 3', 'number', 0,9999999.99 , 10, $_POST['return_7_k3'], '');
        $errors .= $check->value;
        $return_7_k3 = $_POST['return_7_k3'];
    }
    if (isset($_POST['return_20_k1'])) {
        $check = new CheckFields('Возврат касса 1', 'number', 0,9999999.99 , 10, $_POST['return_20_k1'], '');
        $errors .= $check->value;
        $return_20_k1 = $_POST['return_20_k1'];
    }
    if (isset($_POST['return_20_k2'])) {
        $check = new CheckFields('Возврат касса 2', 'number', 0,9999999.99 , 10, $_POST['return_20_k2'], '');
        $errors .= $check->value;
        $return_20_k2 = $_POST['return_20_k2'];
    }
    if (isset($_POST['return_20_k3'])) {
        $check = new CheckFields('Возврат касса 3', 'number', 0,9999999.99 , 10, $_POST['return_20_k3'], '');
        $errors .= $check->value;
        $return_20_k3 = $_POST['return_20_k3'];
    }

    //var_dump($errors);

    //if (empty($errors)){
        $element[] = '';
        $element = ['id'=>$id,
                    //'date_cash'=>$date_cash,
                    'date_cash'=>'20-10-2020',
                    'apteka_id'=>$apteka_id,
                    'cash_k1'=>(float) $cash_k1,
                    'cash_k2'=>(float) $cash_k2,
                    'cash_k3'=>(float) $cash_k3,
                    'card_k1'=>(float) $card_k1,
                    'card_k2'=>(float) $card_k2,
                    'card_k3'=>(float) $card_k3,
                    'collection_k1'=>(float) $collection_k1,
                    'collection_k2'=>(float) $collection_k2,
                    'collection_k3'=>(float) $collection_k3,
                    'bank'=>(float) $bank,
                    'number_of_checks'=>(int) $number_of_checks,
                    'discount_k1'=>(float) $discount_k1,
                    'discount_k2'=>(float) $discount_k2,
                    'discount_k3'=>(float) $discount_k3,
                    'increment_k1'=>(float) $increment_k1,
                    'increment_k2'=>(float) $increment_k2,
                    'increment_k3'=>(float) $increment_k3,
                    'round_k1'=>(float) $round_k1,
                    'round_k2'=>(float) $round_k2,
                    'round_k3'=>(float) $round_k3,
                    'turnover_0_k1'=>(float) $turnover_0_k1,
                    'turnover_0_k2'=>(float) $turnover_0_k2,
                    'turnover_0_k3'=>(float) $turnover_0_k3,
                    'turnover_7_k1'=>(float) $turnover_7_k1,
                    'turnover_7_k2'=>(float) $turnover_7_k2,
                    'turnover_7_k3'=>(float) $turnover_7_k3,
                    'turnover_20_k1'=>(float) $turnover_20_k1,
                    'turnover_20_k2'=>(float) $turnover_20_k2,
                    'turnover_20_k3'=>(float) $turnover_20_k3,
                    'return_0_k1'=>(float) $return_0_k1,
                    'return_0_k2'=>(float) $return_0_k2,
                    'return_0_k3'=>(float) $return_0_k3,
                    'return_7_k1'=>(float) $return_7_k1,
                    'return_7_k2'=>(float) $return_7_k2,
                    'return_7_k3'=>(float) $return_7_k3,
                    'return_20_k1'=>(float) $return_20_k1,
                    'return_20_k2'=>(float) $return_20_k2,
                    'return_20_k3'=>(float) $return_20_k3];

        if ($id == 0) {$method = 'new';
        }else {$method = 'update';}

        if (isset($_POST['copy'])){
            $element['id'] = 0;
            $method = 'new';
        }

        //var_dump_($element);
        $save = new SetData('cash_day', $element, $method);

        if ($method == 'new') {$id = $save->result;}
        header("location: ./elem_cash.php?id=$id");
    //}
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

require_once "./elem_cash.html";