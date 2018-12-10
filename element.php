<?php

require_once "./function.php";
require_once "autoload.php";

$errors = '';
$name = '';
$producer = '';
$tnved = '';
$mark = '';
$mnn = '';
$name_torg = '';
$form_prod = '';
$doza = '';
$nom_id = '';
$morion_id = '';
$barcode = '';
$nac = '';
$tax = '';
$gran_price = '';
$sum_com = '';
$amount_in_a_packege = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $field_search = "Код товара";
    $field = 'all';
    $find = new SearchFromNames($id, $field_search, $field);
    $noms = $find->result_data;

    //var_dump($noms);
    foreach ($noms as $nom){
        $name = trim($nom['name']);
        $producer = str_replace('"',' ',$nom['producer']);
        $nom_id = $nom['id'];
        $morion_id = $nom['morion_id'];
        $barcode = $nom['barcode'];
        $tnved = $nom['tnved'];
        $mark = $nom['m_name'];
        $mnn = $nom['MNN_name'];
        $nac = $nom['nac'];
        $tax = $nom['tax'];
        $gran_price = $nom['gran_price'];
        $sum_com = $nom['sum_com'];
        $name_torg = $nom['name_torg'];
        $form_prod = trim($nom['form_prod']);
        $doza = $nom['doza'];
        $amount_in_a_package = $nom['amount_in_a_package'];
    }

    $marketings = new SearchFromNames('','', 'marketings');
    $marks = $marketings->result_data;
    //var_dump($marks);

    $mnn_list = new SearchFromNames('','', 'mnn');
    $mnns = $mnn_list->result_data;
    //var_dump($mnns);

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
    //var_dump($mark_id);

    $check = new CheckField('mnn', $_POST['mnn']);
    $mnn = $check->value;
    $errors .= $check->error;

    if (empty($errors)){
        $element = ['id'=>$id,
                    'morion_id'=>(int) $morion_id,
                    'name'=>trim($name),
                    'producer'=>trim($producer),
                    'barcode'=>$barcode,
                    'tnved'=>$tnved,
                    'nac'=>(int) $nac,
                    'tax'=>(int) $tax,
                    'marketing'=>$marketing,
                    'gran_price'=>(float) $gran_price,
                    'sum_com'=>(float) $sum_com,
                    'mnn'=>$mnn,
                    'form_prod'=>$form_prod,
                    'doza'=>(float) $doza,
                    'name_torg'=>$name_torg,
                    'amount_in_a_package'=>(int) $amount_in_a_package];

        if ($id == 0) {
            $method = 'new';
            //var_dump($element);
        }else {
            $method = 'update';
        }

        if (isset($_POST['copy'])){
            $element['id'] = 0;
            $method = 'new';
        }


        $save = new SaveToDB($element, $method);

        if ($method == 'new') {
            $id = $save->result;
        }
        header("location: ./element.php?id=$id");
    }
}

if (isset($_POST['close'])) {
    //var_dump($_COOKIE['text_search']);
    if (isset($_COOKIE['text_search']) && (isset($_COOKIE['field_search']))){
        $str_search = './names.php?search='. $_COOKIE['text_search'] . '&field_search=' . $_COOKIE['field_search'] . '&submit_search=search';
    }else{
        $str_search = './names.php';
    }
    header("location: $str_search");
}

require_once "./element.html";