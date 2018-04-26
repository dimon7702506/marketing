<?php

require_once "autoload.php";

session_start();

$errors = '';
$firm_name = '';
$firm_okpo = '';
$last_receipt_oreder_number = '';
$last_expense_order_number = '';
$last_cashiers_report_number = '';

$requisite = new Requisites($_SESSION['apteka_id']);
$req = $requisite->result_data;

//var_dump($req);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //$find = new SearchFromOrders($id);
    //$order = $find->result_data;

  /*  foreach ($noms as $nom){
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
        $form_prod = $nom['form_prod'];
        $doza = $nom['doza'];
    }*/
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
            'name_torg'=>$name_torg];

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
    if (isset($_COOKIE['text_search']) && (isset($_COOKIE['field_search']))){
        $str_search = './names.php?search='. $_COOKIE['text_search'] . '&field_search=' . $_COOKIE['field_search'] . '&submit_search=search';
    }else{
        $str_search = './names.php';
    }
    header("location: $str_search");
}

require_once "./order.html";