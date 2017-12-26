<?php

require_once "./function.php";
require_once "autoload.php";

$errors = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $field_search = "Код товара";
    $field = 'all';
    $find = new Search($id, $field_search, $field);
    $noms = $find->result_data;

    //var_dump($noms);
    foreach ($noms as $nom){
        $name = $nom['name'];
        $producer = $nom['producer'];
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
    }

    $marketings = new Search('','', 'marketings');
    $marks = $marketings->result_data;
    //var_dump($marks);

    $mnn_list = new Search('','', 'mnn');
    $mnns = $mnn_list->result_data;
    //var_dump($mnns);
}

if (isset($_POST['save'])){

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
                    'morion_id'=>$morion_id,
                    'name'=>$name,
                    'producer'=>$producer,
                    'barcode'=>$barcode,
                    'tnved'=>$tnved,
                    'nac'=>$nac,
                    'tax'=>$tax,
                    'marketing'=>$marketing,
                    'gran_price'=>(float) $gran_price,
                    'sum_com'=>(float) $sum_com,
                    //'MNN_id'=>$MNN_id,
                    'form_prod'=>$form_prod,
                    'name_torg'=>$name_torg];
        $method = 'update';
        //var_dump($element);
        $save = new SaveToDB($element, $method);
        //header('location: ./names.php');
    }
}

require_once "./element.html";