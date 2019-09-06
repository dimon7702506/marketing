<?php

require_once "autoload.php";

$sp_type = 'podr';
$id = '';
$query_type = 'elem';
$field_search = '';

$find = new GetData($sp_type,$id, $field_search, $query_type);
$results = $find->result_data;

//var_dump($results);

foreach ($results as $result){
    if (!$result['saldo_path']) {
        continue;
    }

    $file_in = str_replace('ftp', 'saldo', $result['saldo_path']);
    //var_dump($file_in);
    if (!file_exists($file_in)){
        continue;
    }

    $apteka_id = $result['id'];

    $read_file = new ReadFile($id, $file_in);
    $file = $read_file ->out;
    //var_dump($file);
    if (!count($file)) {
        continue;
    }

    $temp = array_unique(array_column($file, '8'));
    $unique_arr = array_intersect_key($file, $temp);
    $file = $unique_arr;

    foreach ($file as $f){
        //var_dump($f[4]);
        if(!array_key_exists(8, $f)){
            continue;
        }
        if ($f[8] !== 'NULL' && $f[9] > 0) {

            $element['apteka_id'] = $apteka_id;
            $element['tov_id'] = $f[8];
            $element['quan'] = $f[1];
            $element['price'] = $f[9];
            $element['date_created'] = $f[10];
            $element['id'] = 0;

            //var_dump($element);

            $save = new SetData('saldo', $element, 'new');
        }
    }

    unlink($file_in);
}