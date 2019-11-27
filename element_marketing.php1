<?php

require_once "./function.php";
require_once "autoload.php";

$errors = '';
$name = '';
$persent = '';
$summ = '';
$field_search = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $find = new ShowMarketings($id, $field_search);
    $marketings = $find->result_data;

    //var_dump($marketings);
    foreach ($marketings as $marketing){
        $name = trim($marketing['m_name']);
        $id = $marketing['m_id'];
        $persent = $marketing['persent'];
        $summ = $marketing['summ'];
    }
}

if (isset($_POST['save'])){

    $check = new CheckField('name', $_POST['name']);
    $name = $check->value;
    $errors .= $check->error;

    $check = new CheckField('persent', $_POST['persent']);
    $persent = $check->value;
    $errors .= $check->error;

    $check = new CheckField('sum_com', $_POST['summ']);
    $summ = $check->value;
    $errors .= $check->error;

    if (empty($errors)){
        $element = ['id'=>$id,
                    'name'=>trim($name),
                    'persent'=>(int) $persent,
                    'summ'=>(float) $summ
                    ];

        if ($id == 0) {
            $method = 'new';
            //var_dump($element);
        }else {
            $method = 'update';
        }

        $save = new SaveToDBMarketings($element, $method);

        if ($method == 'new') {
            $id = $save->result;
        }
        header("location: ./element_marketing.php?id=$id");
    }
}

if (isset($_POST['close'])) {
    header("location: marketings.php");
}

require_once "./element_marketing.html";