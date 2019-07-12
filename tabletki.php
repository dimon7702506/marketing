<?php

require_once "autoload.php";

array_map('unlink', glob("/var/www/marketing.com/out/Rest*.*"));

$sp_type = 'podr';
$id = '';
$query_type = 'elem';
$field_search = '';

$find = new GetData($sp_type,$id, $field_search, $query_type);
$results = $find->result_data;

//var_dump($results);
/*
$ftp_server = '172.16.1.5';
$ftp_user_name = 'apteka';
$ftp_user_pass = '976179';
*/

$ftp_server = 'ftp.tabletki.ua';
$ftp_user_name = '1149';
$ftp_user_pass = 'c93541cb373b';

$conn_id = ftp_connect($ftp_server);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

foreach ($results as $result){
    if ((!$result['tabletki_id']) || (!$result['saldo_path'])) {
        continue;
    }

    $file_in = $result['saldo_path'];
    $tabletki_id = $result['tabletki_id'];
    $file_out = 'Rest_'.$tabletki_id.'_'.date("Ymd").date("His");

    $read_file = new ReadFile($id, $file_in);
    $file = $read_file ->out;
    //var_dump($file);
    if (!count($file)) {
        continue;
    }

    $dom = new DomDocument('1.0', 'UTF-8');
    $Offers = $dom->appendChild($dom->createElement('Offers'));

    $temp = array_unique(array_column($file, '8'));
    $unique_arr = array_intersect_key($file, $temp);
    $file = $unique_arr;

    foreach ($file as $f){
        //var_dump($f[4]);
        if(!array_key_exists(8, $f)){
            continue;
        }
        if ($f[8] !== 'NULL' && $f[9] > 20) {

            $name = mb_convert_encoding($f[5], "utf-8", "windows-1251");
            $name = str_replace('?','i', $name);
            $producer = mb_convert_encoding($f[6], "utf-8", "windows-1251");

            $Offer = $Offers->appendChild($dom->createElement('Offer'));
            $Offer->setAttribute("Code", $f[8]);
            $Offer->setAttribute("Name", $name);
            $Offer->setAttribute("Producer", $producer);
            $Offer->setAttribute("Tax", $f[7]);
            $Offer->setAttribute("Price", $f[9]);
            $Offer->setAttribute("PriceReserve", $f[9]);
            $Offer->setAttribute("Quantity", $f[1]);
            $Offer->setAttribute("Code1", $f[4]);
        }
    }

    $dom->formatOutput = true;
    $Offers = $dom->saveXML();

    $file_out_xml = $file_out . '.xml';
    $file_out_zip = $file_out . '.zip';

    $dom->save('out/'.$file_out_xml);

    $zip = new ZipArchive();
    $filename = 'out/'.$file_out_zip;

    if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        exit("Невозможно открыть <$filename>\n");
    }

    $zip->addFile('out/'.$file_out_xml,$file_out_xml);
    $zip->close();

    $file = 'out/'.$file_out_zip;
    $remote_file = $file_out_zip;

    if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
    } else {
        echo "Не удалось загрузить $file на сервер\n";
    }
}

ftp_close($conn_id);
