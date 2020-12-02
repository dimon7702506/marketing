<?php

require_once "./function.php";
require_once "autoload.php";

is_user_logged_in();

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
$amount_in_a_package = '';
$project_dl = '';
$project_dl_checked = '';
$project_dl_value = '';
$checked = '';
$internet_price = 0;
$internet_sales = '';
$internet_sales_checked = '';

$covid = '';
$covid_checked = '';
$covid_value = '';

$fix_price = 0;

$covid_protokol = '';
$covid_protokol_checked = '';
$covid_protokol_value = '';

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

        $project_dl = (int) $nom['project_dl'];
        if ($project_dl == 1) {
            $project_dl_checked = 'checked';
        }

        $internet_price = $nom['internet_price'];
        $fix_price = $nom['fix_price'];

        $internet_sales = (int) $nom['internet_sales'];
        if ($internet_sales == 1) {
            $internet_sales_checked = 'checked';
        }

        $covid = (int)$nom['covid'];
        if ($covid == 1) {$covid_checked = 'checked';}

        $covid_protokol = (int)$nom['covid_protokol'];
        if ($covid_protokol == 1) {$covid_protokol_checked = 'checked';}
        //var_dump($project_dl);
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

    if ($_POST['internet_sales'] == 'on'){
        $internet_sales = 1;
    }else{
        $internet_sales = 0;
    }

    if (!empty($_POST['covid'])){$covid_value = $_POST['covid'];}
    if ($covid_value == 'on'){
        $covid = 1;
    }else{
        $covid = 0;
    }

    if (!empty($_POST['covid_protokol'])){$covid_protokol_value = $_POST['covid_protokol'];}
    if ($covid_protokol_value == 'on'){
        $covid_protokol = 1;
    }else{
        $covid_protokol = 0;
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
                    'covid_protokol'=>$covid_protokol
                    ];

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

        //var_dump($element);
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