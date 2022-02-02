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

    $marketings = new SearchFromNames('','', 'marketings');
    $marks = $marketings->result_data;

    $mnn_list = new SearchFromNames('','', 'mnn');
    $mnns = $mnn_list->result_data;

    $form_prod_list = new SearchFromNames('','','form_prod');
    $form_prods = $form_prod_list->result_data;
}

if (isset($_POST['save']) || isset($_POST['copy'])){

    $check = new CheckField('name', $_POST['name']);
    $name = $check->value;
    $errors .= $check->error;

    $check = new CheckField('producer', $_POST['producer']);
    $producer = $check->value;
    $errors .= $check->error;

    $check = new CheckField('barcode', $_POST['barcode']);
    $barcode = $check->value;
    $errors .= $check->error;

    $check = new CheckField('tnved', $_POST['tnved']);
    $tnved = $check->value;
    $errors .= $check->error;

    $check = new CheckField('id', $id);
    $errors .= $check->error;

    $check = new CheckField('nac', $_POST['nac']);
    $nac = $check->value;
    $errors .= $check->error;

    $check = new CheckField('tax', $_POST['tax']);
    $tax = $check->value;
    $errors .= $check->error;

    $check = new CheckField('bonus', $_POST['bonus']);
    $bonus = $check->value;
    $errors .= $check->error;

    $check = new CheckField('gran_price', $_POST['gran_price']);
    $gran_price = $check->value;
    $errors .= $check->error;

    $check = new CheckField('sum_com', $_POST['sum_com']);
    $sum_com = $check->value;
    $errors .= $check->error;

    $check = new CheckField('name_torg', $_POST['name_torg']);
    $name_torg = $check->value;
    $errors .= $check->error;

    $check = new CheckField('form_prod', $_POST['form_prod']);
    $form_prod = $check->value;
    $errors .= $check->error;

    $check = new CheckField('doza', $_POST['doza']);
    $doza = $check->value;
    $errors .= $check->error;

    $check = new CheckField('amount_in_a_package', $_POST['amount_in_a_package']);
    $amount_in_a_package = $check->value;
    $errors .= $check->error;

    $check = new CheckField('morion_id', $_POST['morion_id']);
    $morion_id = $check->value;
    $errors .= $check->error;

    $check = new CheckField('marketing', $_POST['marketing']);
    $marketing = $check->value;
    $errors .= $check->error;

    $check = new CheckField('mnn', $_POST['mnn']);
    $mnn = $check->value;
    $errors .= $check->error;

    if (!empty($_POST['project_dl'])) {$project_dl_value = $_POST['project_dl'];}
    if ($project_dl_value == 'on'){$project_dl = 1;}else{$project_dl = 0;}

    $check = new CheckField('internet_price', $_POST['internet_price']);
    $internet_price = $check->value;
    $errors .= $check->error;

    $check = new CheckField('fix_price', $_POST['fix_price']);
    $fix_price = $check->value;
    $errors .= $check->error;

    if ($_POST['internet_sales'] == 'on'){$internet_sales = 1;
    }else{$internet_sales = 0;}

    if (!empty($_POST['covid'])){$covid_value = $_POST['covid'];}
    if ($covid_value == 'on'){$covid = 1;
    }else{$covid = 0;}

    if (!empty($_POST['insulin'])){$insulin_value = $_POST['insulin'];}
    if ($insulin_value == 'on'){$insulin = 1;
    }else{$insulin = 0;}

    if (!empty($_POST['baby_box'])){$baby_box_value = $_POST['baby_box'];}
    if ($baby_box_value == 'on'){$baby_box = 1;
    }else{$baby_box = 0;}

    if (!empty($_POST['covid_protokol'])){$covid_protokol_value = $_POST['covid_protokol'];}
    if ($covid_protokol_value == 'on'){$covid_protokol = 1;
    }else{$covid_protokol = 0;}

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