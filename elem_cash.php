<?php

require_once "./function.php";
require_once "autoload.php";

is_user_logged_in();

$errors = '';
$date_cash = '';
$apteka_id = 0; $apteka = '';
$cash_start_k1 = 0; $cash_start_k2 = 0; $cash_start_k3 = 0;
$cash_k1 = 0; $cash_k2 = 0; $cash_k3 = 0;
$card_k1 = 0; $card_k2 = 0; $card_k3 = 0;
$collection_k1 = 0; $collection_k2 = 0; $collection_k3 = 0;
$cash_end_k1 = 0; $cash_end_k2 = 0; $cash_end_k3 = 0;
$costs = 0;
$count_k1 = 0; $count_k2 = 0; $count_k3 = 0;
$discount_k1 = 0; $discount_k2 = 0; $discount_k3 = 0;
$increment_k1 = 0; $increment_k2 = 0; $increment_k3 = 0;
$round_k1 = 0; $round_k2 = 0; $round_k3 = 0;
$turnover_0_k1 = 0; $turnover_0_k2 = 0; $turnover_0_k3 = 0;
$turnover_7_k1 = 0; $turnover_7_k2 = 0; $turnover_7_k3 = 0;
$turnover_20_k1 = 0; $turnover_20_k2 = 0; $turnover_20_k3 = 0;
$return_0_k1 = 0; $return_0_k2 = 0; $return_0_k3 = 0;
$return_7_k1 = 0; $return_7_k2 = 0; $return_7_k3 = 0;
$return_20_k1 = 0; $return_20_k2 = 0; $return_20_k3 = 0;
$error_check = 0;
$errors_print = '';
$unique_key = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $find = new GetData('cash_day',$id, 'ID', 'elem');
    $results = $find->result_data;

    foreach ($results as $result){
        $date_cash = $result['date_cash'];
        $apteka_id = $result['apteka_id']; $apteka = $result['apteka'];
        $cash_start_k1 = $result['cash_start_k1']; $cash_start_k2 = $result['cash_start_k2']; $cash_start_k3 = $result['cash_start_k3'];
        $cash_k1 = $result['cash_k1']; $cash_k2 = $result['cash_k2']; $cash_k3 = $result['cash_k3'];
        $card_k1 = $result['card_k1']; $card_k2 = $result['card_k2']; $card_k3 = $result['card_k3'];
        $count_k1 = $result['count_k1']; $count_k2 = $result['count_k2']; $count_k3 = $result['count_k3'];
        $collection_k1 = $result['collection_k1']; $collection_k2 = $result['collection_k2']; $collection_k3 = $result['collection_k3'];
        $cash_end_k1 = $result['cash_end_k1']; $cash_end_k2 = $result['cash_end_k2']; $cash_end_k3 = $result['cash_end_k3'];
        $costs = $result['costs'];
        $discount_k1 = $result['discount_k1']; $discount_k2 = $result['discount_k2']; $discount_k3 = $result['discount_k3'];
        $increment_k1 = $result['increment_k1']; $increment_k2 = $result['increment_k2']; $increment_k3 = $result['increment_k3'];
        $round_k1 = $result['round_k1']; $round_k2 = $result['round_k2']; $round_k3 = $result['round_k3'];
        $turnover_0_k1 = $result['turnover_0_k1']; $turnover_0_k2 = $result['turnover_0_k2']; $turnover_0_k3 = $result['turnover_0_k3'];
        $turnover_7_k1 = $result['turnover_7_k1']; $turnover_7_k2 = $result['turnover_7_k2']; $turnover_7_k3 = $result['turnover_7_k3'];
        $turnover_20_k1 = $result['turnover_20_k1']; $turnover_20_k2 = $result['turnover_20_k2']; $turnover_20_k3 = $result['turnover_20_k3'];
        $return_0_k1 = $result['return_0_k1']; $return_0_k2 = $result['return_0_k2']; $return_0_k3 = $result['return_0_k3'];
        $return_7_k1 = $result['return_7_k1']; $return_7_k2 = $result['return_7_k2']; $return_7_k3 = $result['return_7_k3'];
        $return_20_k1 = $result['return_20_k1']; $return_20_k2 = $result['return_20_k2']; $return_20_k3 = $result['return_20_k3'];
        $error_check = $result['error_check'];
        $unique_key = $result['unique_key'];
    }

    $sum_cash_start = number_format($cash_start_k1 + $cash_start_k2 + $cash_start_k3,2, ',', ' ');
    $sum_cash = number_format($cash_k1 + $cash_k2 + $cash_k3,2, ',', ' ');
    $sum_card = number_format($card_k1 + $card_k2 + $card_k3,2, ',', ' ');

    $sum_k1 = number_format($cash_k1 + $card_k1,2, ',', ' ');
    $sum_k2 = number_format($cash_k2 + $card_k2,2, ',', ' ');
    $sum_k3 = number_format($cash_k3 + $card_k3,2, ',', ' ');
    $sum_k = $cash_k1 + $cash_k2 + $cash_k3 + $card_k1 + $card_k2 + $card_k3;
    $sum_k_print = number_format($sum_k,2, ',', ' ');

    $count_k= $count_k1 + $count_k2 + $count_k3;
    
    $sum_collection = $collection_k1 + $collection_k2 + $collection_k3;
    $sum_collection_print = number_format($sum_collection,2, ',', ' ');

    $cash_end_k1 = $cash_start_k1 + $cash_k1 - $collection_k1;
    $cash_end_k2 = $cash_start_k2 + $cash_k2 - $collection_k2;
    $cash_end_k3 = $cash_start_k3 + $cash_k3 - $collection_k3;
    $cash_end_k1_print = number_format($cash_end_k1,2, ',', ' ');
    $cash_end_k2_print = number_format($cash_end_k2,2, ',', ' ');
    $cash_end_k3_print = number_format($cash_end_k3,2, ',', ' ');
    $sum_end = number_format($cash_end_k1 + $cash_end_k2 + $cash_end_k3, 2, ',',' ');

    $collection_office = number_format($sum_collection - $costs, 2, ',', ' ');

    if ($count_k> 0) {$cash_avg = number_format($sum_k / $count_k, 2, ',', ' ');
    }else{$cash_avg = 0;}

    $sum_discount = number_format($discount_k1 + $discount_k2 + $discount_k3,2, ',', ' ');
    $sum_increment = number_format($increment_k1 + $increment_k2 + $increment_k3,2, ',', ' ');
    $sum_round = $round_k1 + $round_k2 + $round_k3;
    $sum_round_print = number_format($round_k1 + $round_k2 + $round_k3,2, ',', ' ');
    $sum_turnover_0 = $turnover_0_k1 + $turnover_0_k2 + $turnover_0_k3;
    $sum_turnover_0_print = number_format($turnover_0_k1 + $turnover_0_k2 + $turnover_0_k3,2, ',', ' ');
    $sum_turnover_7 = $turnover_7_k1 + $turnover_7_k2 + $turnover_7_k3;
    $sum_turnover_7_print = number_format($turnover_7_k1 + $turnover_7_k2 + $turnover_7_k3,2, ',', ' ');
    $sum_turnover_20 = $turnover_20_k1 + $turnover_20_k2 + $turnover_20_k3;
    $sum_turnover_20_print = number_format($turnover_20_k1 + $turnover_20_k2 + $turnover_20_k3,2, ',', ' ');
    $sum_return_0 = number_format($return_0_k1 + $return_0_k2 + $return_0_k3,2, ',', ' ');
    $sum_return_7 = number_format($return_7_k1 + $return_7_k2 + $return_7_k3,2, ',', ' ');
    $sum_return_20 = number_format($return_20_k1 + $return_20_k2 + $return_20_k3,2, ',', ' ');

    $error_check = round($sum_k - $sum_turnover_0 - $sum_turnover_7 - $sum_turnover_20 - $sum_round, 2);
    if ($error_check != 0) {
        $errors_check_print = 'Расхождение в данных: ' . number_format($error_check, 2, ',', ' ');
    }else{
        $errors_check_print = '';
    }

    if($date_cash == '') {$date_cash = date("Y-m-d", strtotime('yesterday'));}
    if($apteka_id == '') {$apteka_id = get_apteka_id();}
    if ($apteka == '') {
        $new_apteka = new GetData('podr',  get_apteka_id(), 'id', "elem");
        $new_results = $new_apteka->result_data;
        foreach ($new_results as $new_result) {$apteka = $new_result['apteka'];}
    }

    $saldo_start = new CashDay();
    $cash_start = $saldo_start->getSaldo($apteka_id, $date_cash);
    if($cash_start_k1 == 0) {$cash_start_k1 = $cash_start[0]['cash_end_k1'];}
    if($cash_start_k2 == 0) {$cash_start_k2 = $cash_start[0]['cash_end_k2'];}
    if($cash_start_k3 == 0) {$cash_start_k3 = $cash_start[0]['cash_end_k3'];}

    if ($unique_key == ''){$unique_key = $date_cash . '_' . $apteka_id;}

    $find_list = new GetData('podr','','', 'list');
    $lists = $find_list->result_data;
    //var_dump_($lists);
}

if (isset($_POST['save']) || isset($_POST['copy'])){

    if (isset($_POST['date_cash'])) {
        $check = new CheckFields('Дата', 'date', 0,0 , 0, $_POST['date_cash'], 'required');
        $errors .= $check->error;
        $date_cash = $check->value;
    }
    if (isset($_POST['cash_start_k1'])) {
        $check = new CheckFields('Начальный остаток касса 1', 'number', 0,9999999.99 , 10, $_POST['cash_start_k1'], '');
        $errors .= $check->error;
        $cash_start_k1 = $check->value;
    }
    if (isset($_POST['cash_start_k2'])) {
        $check = new CheckFields('Начальный остаток касса 2', 'number', 0,9999999.99 , 10, $_POST['cash_start_k2'], '');
        $errors .= $check->error;
        $cash_start_k2 = $check->value;
    }
    if (isset($_POST['cash_start_k3'])) {
        $check = new CheckFields('Начальный остаток касса 3', 'number', 0,9999999.99 , 10, $_POST['cash_start_k3'], '');
        $errors .= $check->error;
        $cash_start_k3 = $check->value;
    }
    if (isset($_POST['cash_k1'])) {
        $check = new CheckFields('Выручка касса 1', 'number', 0,9999999.99 , 10, $_POST['cash_k1'], '');
        $errors .= $check->error;
        $cash_k1 = $check->value;
    }
    if (isset($_POST['cash_k2'])) {
        $check = new CheckFields('Выручка касса 2', 'number', 0,9999999.99 , 10, $_POST['cash_k2'], '');
        $errors .= $check->error;
        $cash_k2 = $check->value;
    }
    if (isset($_POST['cash_k3'])) {
        $check = new CheckFields('Выручка касса 3', 'number', 0,9999999.99 , 10, $_POST['cash_k3'], '');
        $errors .= $check->error;
        $cash_k3 = $check->value;
    }
    if (isset($_POST['card_k1'])) {
        $check = new CheckFields('Выручка касса 1', 'number', 0,9999999.99 , 10, $_POST['card_k1'], '');
        $errors .= $check->error;
        $card_k1 = $check->value;
    }
    if (isset($_POST['card_k2'])) {
        $check = new CheckFields('Выручка касса 2', 'number', 0,9999999.99 , 10, $_POST['card_k2'], '');
        $errors .= $check->error;
        $card_k2 = $check->value;
    }
    if (isset($_POST['card_k3'])) {
        $check = new CheckFields('Выручка касса 3', 'number', 0,9999999.99 , 10, $_POST['card_k3'], '');
        $errors .= $check->error;
        $card_k3 = $check->value;
    }
    if (isset($_POST['count_k1'])) {
        $check = new CheckFields('Количество чеков касса 1', 'number', 0,999 , 10, $_POST['count_k1'], '');
        $errors .= $check->error;
        $count_k1 = $check->value;
    }
    if (isset($_POST['count_k2'])) {
        $check = new CheckFields('Количество чеков касса 2', 'number', 0,999 , 10, $_POST['count_k2'], '');
        $errors .= $check->error;
        $count_k2 = $check->value;
    }
    if (isset($_POST['count_k3'])) {
        $check = new CheckFields('Количество чеков касса 3', 'number', 0,999 , 10, $_POST['count_k3'], '');
        $errors .= $check->error;
        $count_k3 = $check->value;
    }
    if (isset($_POST['collection_k1'])) {
        $check = new CheckFields('Выручка касса 1', 'number', 0,9999999.99 , 10, $_POST['collection_k1'], '');
        $errors .= $check->error;
        $collection_k1 = $check->value;
    }
    if (isset($_POST['collection_k2'])) {
        $check = new CheckFields('Выручка касса 2', 'number', 0,9999999.99 , 10, $_POST['collection_k2'], '');
        $errors .= $check->error;
        $collection_k2 = $check->value;
    }
    if (isset($_POST['collection_k3'])) {
        $check = new CheckFields('Выручка касса 3', 'number', 0,9999999.99 , 10, $_POST['collection_k3'], '');
        $errors .= $check->error;
        $collection_k3 = $check->value;
    }
    if (isset($_POST['cash_end_k1'])) {
        $check = new CheckFields('Остаток', 'number', 0,9999999.99 , 10, $_POST['cash_end_k1'], '');
        $errors .= $check->error;
        $cash_end_k1 = $check->value;
    }
    if (isset($_POST['cash_end_k2'])) {
        $check = new CheckFields('Остаток', 'number', 0,9999999.99 , 10, $_POST['cash_end_k2'], '');
        $errors .= $check->error;
        $cash_end_k2 = $check->value;
    }
    if (isset($_POST['cash_end_k3'])) {
        $check = new CheckFields('Остаток', 'number', 0,9999999.99 , 10, $_POST['cash_end_k3'], '');
        $errors .= $check->error;
        $cash_end_k3 = $check->value;
    }
    if (isset($_POST['costs'])) {
        $check = new CheckFields('Сдано в банк', 'number', 0,9999999.99 , 10, $_POST['costs'], '');
        $errors .= $check->error;
        $costs = $check->value;
    }
    if (isset($_POST['discount_k1'])) {
        $check = new CheckFields('Скидка касса 1', 'number', 0,9999999.99 , 10, $_POST['discount_k1'], '');
        $errors .= $check->error;
        $discount_k1 = $check->value;
    }
    if (isset($_POST['discount_k2'])) {
        $check = new CheckFields('Скидка касса 2', 'number', 0,9999999.99 , 10, $_POST['discount_k2'], '');
        $errors .= $check->error;
        $discount_k2 = $check->value;
    }
    if (isset($_POST['discount_k3'])) {
        $check = new CheckFields('Скидка касса 3', 'number', 0,9999999.99 , 10, $_POST['discount_k3'], '');
        $errors .= $check->error;
        $discount_k3 = $check->value;
    }
    if (isset($_POST['increment_k1'])) {
        $check = new CheckFields('Скидка касса 1', 'number', 0,9999999.99 , 10, $_POST['increment_k1'], '');
        $errors .= $check->error;
        $increment_k1 = $check->value;
    }
    if (isset($_POST['increment_k2'])) {
        $check = new CheckFields('Скидка касса 2', 'number', 0,9999999.99 , 10, $_POST['increment_k2'], '');
        $errors .= $check->error;
        $increment_k2 = $check->value;
    }
    if (isset($_POST['increment_k3'])) {
        $check = new CheckFields('Скидка касса 3', 'number', 0,9999999.99 , 10, $_POST['increment_k3'], '');
        $errors .= $check->error;
        $increment_k3 = $check->value;
    }
    if (isset($_POST['round_k1'])) {
        $check = new CheckFields('Округление касса 1', 'number', -9999999.99,9999999.99 , 10, $_POST['round_k1'], '');
        $errors .= $check->error;
        $round_k1 = $_POST['round_k1'];
    }
    if (isset($_POST['round_k2'])) {
        $check = new CheckFields('Округление касса 2', 'number', -9999999.99,9999999.99 , 10, $_POST['round_k2'], '');
        $errors .= $check->error;
        $round_k2 = $check->value;
    }
    if (isset($_POST['round_k3'])) {
        $check = new CheckFields('Округление касса 3', 'number', -9999999.99,9999999.99 , 10, $_POST['round_k3'], '');
        $errors .= $check->error;
        $round_k3 = $check->value;
    }
    if (isset($_POST['turnover_0_k1'])) {
        $check = new CheckFields('Оборот касса 1', 'number', 0,9999999.99 , 10, $_POST['turnover_0_k1'], '');
        $errors .= $check->error;
        $turnover_0_k1 = $check->value;
    }
    if (isset($_POST['turnover_0_k2'])) {
        $check = new CheckFields('Оборот касса 2', 'number', 0,9999999.99 , 10, $_POST['turnover_0_k2'], '');
        $errors .= $check->error;
        $turnover_0_k2 = $check->value;
    }
    if (isset($_POST['turnover_0_k3'])) {
        $check = new CheckFields('Оборот касса 3', 'number', 0,9999999.99 , 10, $_POST['turnover_0_k3'], '');
        $errors .= $check->error;
        $turnover_0_k3 = $check->value;
    }
    if (isset($_POST['turnover_7_k1'])) {
        $check = new CheckFields('Оборот касса 1', 'number', 0,9999999.99 , 10, $_POST['turnover_7_k1'], '');
        $errors .= $check->error;
        $turnover_7_k1 = $check->value;
    }
    if (isset($_POST['turnover_7_k2'])) {
        $check = new CheckFields('Оборот касса 2', 'number', 0,9999999.99 , 10, $_POST['turnover_7_k2'], '');
        $errors .= $check->error;
        $turnover_7_k2 = $check->value;
    }
    if (isset($_POST['turnover_7_k3'])) {
        $check = new CheckFields('Оборот касса 3', 'number', 0,9999999.99 , 10, $_POST['turnover_7_k3'], '');
        $errors .= $check->error;
        $turnover_7_k3 = $check->value;
    }
    if (isset($_POST['turnover_20_k1'])) {
        $check = new CheckFields('Оборот касса 1', 'number', 0,9999999.99 , 10, $_POST['turnover_20_k1'], '');
        $errors .= $check->error;
        $turnover_20_k1 = $check->value;
    }
    if (isset($_POST['turnover_20_k2'])) {
        $check = new CheckFields('Оборот касса 2', 'number', 0,9999999.99 , 10, $_POST['turnover_20_k2'], '');
        $errors .= $check->error;
        $turnover_20_k2 = $check->value;
    }
    if (isset($_POST['turnover_20_k3'])) {
        $check = new CheckFields('Оборот касса 3', 'number', 0,9999999.99 , 10, $_POST['turnover_20_k3'], '');
        $errors .= $check->error;
        $turnover_20_k3 = $check->value;
    }
    if (isset($_POST['return_0_k1'])) {
        $check = new CheckFields('Возврат касса 1', 'number', 0,9999999.99 , 10, $_POST['return_0_k1'], '');
        $errors .= $check->error;
        $return_0_k1 = $check->value;
    }
    if (isset($_POST['return_0_k2'])) {
        $check = new CheckFields('Возврат касса 2', 'number', 0,9999999.99 , 10, $_POST['return_0_k2'], '');
        $errors .= $check->error;
        $return_0_k2 = $check->value;
    }
    if (isset($_POST['return_0_k3'])) {
        $check = new CheckFields('Возврат касса 3', 'number', 0,9999999.99 , 10, $_POST['return_0_k3'], '');
        $errors .= $check->error;
        $return_0_k3 = $check->value;
    }
    if (isset($_POST['return_7_k1'])) {
        $check = new CheckFields('Возврат касса 1', 'number', 0,9999999.99 , 10, $_POST['return_7_k1'], '');
        $errors .= $check->error;
        $return_7_k1 = $check->value;
    }
    if (isset($_POST['return_7_k2'])) {
        $check = new CheckFields('Возврат касса 2', 'number', 0,9999999.99 , 10, $_POST['return_7_k2'], '');
        $errors .= $check->error;
        $return_7_k2 = $check->value;
    }
    if (isset($_POST['return_7_k3'])) {
        $check = new CheckFields('Возврат касса 3', 'number', 0,9999999.99 , 10, $_POST['return_7_k3'], '');
        $errors .= $check->error;
        $return_7_k3 = $check->value;
    }
    if (isset($_POST['return_20_k1'])) {
        $check = new CheckFields('Возврат касса 1', 'number', 0,9999999.99 , 10, $_POST['return_20_k1'], '');
        $errors .= $check->error;
        $return_20_k1 = $check->value;
    }
    if (isset($_POST['return_20_k2'])) {
        $check = new CheckFields('Возврат касса 2', 'number', 0,9999999.99 , 10, $_POST['return_20_k2'], '');
        $errors .= $check->error;
        $return_20_k2 = $check->value;
    }
    if (isset($_POST['return_20_k3'])) {
        $check = new CheckFields('Возврат касса 3', 'number', 0,9999999.99 , 10, $_POST['return_20_k3'], '');
        $errors .= $check->error;
        $return_20_k3 = $check->value;
    }

    $find_id = new GetData('podr', $_POST['apteka'],'name', 'id');
    $related_id = $find_id->result_data;
    $apteka_id = (int) $related_id[0]['id'];

    $apteka_id_txt = $apteka_id;
    if (strlen($apteka_id) == 1) {$apteka_id_txt = '0' . $apteka_id;}
    $unique_key = $date_cash . '_' . $apteka_id_txt;
    $unique = new GetData('cash_day', $unique_key, 'unique_key', "list", $date_cash, $date_cash);
    $new_results = $unique->result_data;
    //var_dump_($new_results);
    //var_dump_($unique_key);

    foreach ($new_results as $new_result) {
        if ((int) $new_result['id'] != $id) {
            $errors .= 'Такая запись уже есть';
        }
    }

    $errors_print = $errors . $errors_check_print;
    if (empty($errors)){

        $element[] = '';
        $element = ['id'=>$id,
                    'date_cash'=>$date_cash,
                    'apteka_id'=>$apteka_id,
                    'cash_start_k1'=>(float) $cash_start_k1,
                    'cash_start_k2'=>(float) $cash_start_k2,
                    'cash_start_k3'=>(float) $cash_start_k3,
                    'cash_k1'=>(float) $cash_k1,
                    'cash_k2'=>(float) $cash_k2,
                    'cash_k3'=>(float) $cash_k3,
                    'card_k1'=>(float) $card_k1,
                    'card_k2'=>(float) $card_k2,
                    'card_k3'=>(float) $card_k3,
                    'count_k1'=>(int) $count_k1,
                    'count_k2'=>(int) $count_k2,
                    'count_k3'=>(int) $count_k3,
                    'count_k'=> $count_k1 + $count_k2 + $count_k3,
                    'collection_k1'=>(float) $collection_k1,
                    'collection_k2'=>(float) $collection_k2,
                    'collection_k3'=>(float) $collection_k3,
                    'cash_end_k1'=>(float) $cash_end_k1,
                    'cash_end_k2'=>(float) $cash_end_k2,
                    'cash_end_k3'=>(float) $cash_end_k3,           
                    'costs'=>(float) $costs,
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
                    'return_20_k3'=>(float) $return_20_k3,
                    'error_check'=>(float) $error_check,
                    'unique_key'=>trim($unique_key)];

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
    }
}

if (isset($_POST['close'])) {
    if (isset($_COOKIE['text_search']) && (isset($_COOKIE['field_search']))){
        $str_search = './spr.php?search='. $_COOKIE['text_search'] . '&field_search=' . $_COOKIE['field_search'] . '&submit_search=search';
    }else{
        if ($sp_type == 'marketing') {$str_search = './spr.php?submit_search';
        }else {$str_search = './spr.php';}
    }
    header("location: $str_search");
}

require_once "./elem_cash.html";