<?php

require_once "./function.php";
require_once "autoload.php";

if (isset($_GET['sp_type'])){
    $sp_type = $_GET['sp_type'];
    setcookie('sp_type', $sp_type);
    //var_dump($sp_type);
}

if (isset($_GET['submit_search'])) {
    $field = '';
    $text_search = $_GET['search'];
    $field_search = $_GET['field_search'];
    $sp_type = $_COOKIE['sp_type'];
    if ($sp_type == 'podr'){
        $cols = ['id'=>'ID',
                 'name'=>'Наименование',
                 'firm_id'=>'Фирма',
                 'modif'=>'Модификация'];
    }
//    foreach ($cols as $col){
//        var_dump($col);
//    }
    $find = new GetData($sp_type, $text_search, $field_search, $field);
    //var_dump($find->result_data);
    $res = $find->result_data;
    $count = count($res);
    setcookie("text_search", $text_search);
    setcookie("field_search", $field_search);
}

if (isset($_GET['submit_new'])) {
    header("location: ./element_mnn.php?id=0");
}

require_once "./spr.html";