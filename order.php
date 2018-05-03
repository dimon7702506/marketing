<?php

require_once "autoload.php";

session_start();

$errors = '';
$order = '';
if (empty($date_doc)){
    $date_doc = date("m.d.y");

}
$firm_name = '';
$sum = 0;
$num = 1;
$firm_okpo = '';
$last_receipt_oreder_number = 0;
$last_expense_order_number = 0;
$last_cashiers_report_number = 0;

$requisite = new Requisites($_SESSION['apteka_id']);
$req = $requisite->result_data;
var_dump($req);

$head = $req[0]['firma'] . ', ' . $req[0]['apteka'];

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
    $orders_type = new ShowOrdersType();
    $order_type = $orders_type->result_data;
    //var_dump($order_type);

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
    //var_dump($mark_id);

    if (empty($errors)){
        $element = ['id'=>$id,
            'date'=>$date_doc,
            'order_type'=>$order_type,
            'apteka_id'=>$_SESSION['apteka_id'],
            'num'=>$_SESSION['apteka_id'],
            'sum'=>(float) $sum];

        if ($id == 0) {
            $method = 'new';
            var_dump($element);
        }else {
            $method = 'update';
        }

        $save = new SaveToDBOrders($element, $method);

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