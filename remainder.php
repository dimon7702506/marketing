<?php

require_once "autoload.php";
require_once "function.php";

ini_set('max_execution_time', '3600');

$sp_type = 'podr';
$id = '';
$query_type = 'elem';
$field_search = '';

$del = new DelData('remainder');

$find = new GetData($sp_type,$id, $field_search, $query_type);
$results = $find->result_data;

foreach ($results as $result){
    if (!$result['saldo_path']) {continue;}

    $file_in = $result['saldo_path'];

    if (!file_exists($file_in)){continue;}

    $read_file = new ReadFile($file_in);
    $file = $read_file ->out;
    //var_dump_($file);

    $temp = array_unique(array_column($file, '8'));
    $unique_arr = array_intersect_key($file, $temp);
    $file = $unique_arr;

    foreach ($file as $f){
        //var_dump($f);
        if(!array_key_exists(8, $f)){continue;}

        if ($f[8] !== 'NULL' && $f[9] > 20 && $f[11] >= 0.01) {

            $Price_sp = $f[2];

            $element = ['apteka_id'=>(int) $result['id'],
                'name_id'=>(int) $f[8],
                'price'=>$Price_sp,
                'quantity'=>$f[11]];
            $element['id'] = 0;

            $save = new SetData('remainder', $element, 'new');
        }
    }
    //var_dump_($element);
}