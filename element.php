<?php

require_once "./function.php";
require_once "autoload.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $field_search = "Код товара";
    $field = 'all';
    $find = new Find($id, $field_search, $field);
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

    }

    $marketings = new Find('','', 'marketings');
    $marks = $marketings->result_data;
    //var_dump($marks);
/*    foreach ($marks as $mar) {
        echo "$mar[m_name].<br>";
    }*/
}

require_once "./element.html";