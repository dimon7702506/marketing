<?php

require_once "autoload.php";
require_once "function.php";

$sp_type = 'podr';
$id = '';
$query_type = 'elem';
$field_search = '';

$del = new DelData('remainder');

$find = new GetData($sp_type,$id, $field_search, $query_type);
$results = $find->result_data;

foreach ($results as $result){
    if (!$result['saldo_path']) {continue;}

    $file_in = str_replace("ftp", "saldo", $result['saldo_path']);

    if (!file_exists($file_in)){continue;}

    $read_file = new ReadFile($file_in);
    $file = $read_file ->out;
//    var_dump_($file_in);

    $num = 0;
    foreach ($file as $f){
        //var_dump($f);
        if(!array_key_exists(8, $f)){continue;}

        if ($f[8] !== 'NULL' && $f[11] >= 0.01) {

            $num ++;
            $Price_sp = $f[2];

            $element = ['apteka_id'=>(int) $result['id'],
                'name_id'=>(int) $f[8],
                'price'=>$Price_sp,
                'quantity'=>$f[11]];
            $element['id'] = 0;

            $save = new SetData('remainder', $element, 'new');
        }
    }
}