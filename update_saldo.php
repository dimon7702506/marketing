<?php

require_once "autoload.php";

array_map('unlink', glob("/var/www/marketing.com/out/saldo*.*"));

$sp_type = 'podr';
$id = '';
$query_type = 'elem';
$field_search = '';
$ap_list = [];

$find = new GetData($sp_type,$id, $field_search, $query_type);
$results = $find->result_data;

//var_dump($results);

$file_out = 'saldo';

$dom = new DomDocument('1.0', 'UTF-8');

foreach ($results as $result){

    if (!$result['saldo_path']) {
        continue;
    }

    $file_in = str_replace('ftp', 'saldo', $result['saldo_path']);
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

    foreach ($file as $f){

        if(!array_key_exists(8, $f)){
            continue;
        }

        if ($f[8] != 'NULL') {

            //var_dump($apteka_id);
            //var_dump($f[8]);

            $Offers = $dom->appendChild($dom->createElement('row'));
            $Offer = $Offers->appendChild($dom->createElement('field'));
            $Offer->setAttribute("apteka_id", $apteka_id);
            $Offer->setAttribute("tov_id", $f[8]);
            $Offer->setAttribute("quan", $f[1]);
            $Offer->setAttribute("price", $f[9]);
            $Offer->setAttribute("date_created", $f[10]);
        }
    }
    array_push($ap_list, $apteka_id);
    //unlink($file_in);
}
$dom->formatOutput = true;
$Offers = $dom->saveXML();

$file_out_xml = $file_out . '.xml';

$dom->save('/var/www/marketing.com/out/'.$file_out_xml);

var_dump($ap_list);

$del = new Delete($ap_list);
$results = $del->result_data;