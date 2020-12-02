<?php

require_once "./function.php";
require_once "autoload.php";

is_user_logged_in();

$errors = '';
$mnn = '';
$sickness = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $field_search = "ID";
    $field = 'all';
    $find = new ShowMNN($id, $field_search, $field);
    $mnnss = $find->result_data;

    foreach ($mnnss as $mnns){
        //var_dump($mnns);
        $mnn = $mnns['MNN_name'];
        $sickness = $mnns['sickness_name'];
    }

    $sickness_list = new ShowSickness('','', '');
    $sickness_l = $sickness_list->result_data;
    //var_dump($sickness_l);
}

if (isset($_POST['save']) || isset($_POST['copy'])){

    $check = new CheckField('mnn', $_POST['mnn']);
    $mnn = $check->value;
    $errors .= $check->error;

    $check = new CheckField('sickness', $_POST['sickness']);
    $sickness = $check->value;
    $errors .= $check->error;

    if (empty($errors)){
        $element = ['id'=>$id,
                    'mnn'=>trim($mnn),
                    'sickness'=>$sickness];

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

        $save = new SaveToDBMNN($element, $method);

        if ($method == 'new') {
            $id = $save->result;
        }
        header("location: ./element_mnn.php?id=$id");
    }
}

if (isset($_POST['close'])) {
    //var_dump($_COOKIE['text_search']);
    if (isset($_COOKIE['text_search']) && (isset($_COOKIE['field_search']))){
        $str_search = './mnn.php?search='. $_COOKIE['text_search'] . '&field_search=' . $_COOKIE['field_search'] . '&submit_search=search';
    }else{
        $str_search = './mnn.php';
    }
    header("location: $str_search");
}

require_once "./element_mnn.html";