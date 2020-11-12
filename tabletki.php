<?php

require_once "autoload.php";

//delete old files
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
echo "login: $login_result\n";
echo "<br>";

ftp_pasv($conn_id, true);

foreach ($results as $result){
    if ((!$result['tabletki_id']) || (!$result['saldo_path'])) {
        continue;
    }
    if ($result['tabletki_id'] == 0){
        continue;
    }

    $file_in = $result['saldo_path'];

    if (!file_exists($file_in)){
        continue;
    }

    $tabletki_id = $result['tabletki_id'];
    $file_out = 'Rest_'.$tabletki_id.'_'.date("Ymd").date("His");

    $read_file = new ReadFile($id, $file_in);
    $file = $read_file ->out;
    var_dump($file);

    $dom = new DomDocument('1.0', 'UTF-8');
    $Offers = $dom->appendChild($dom->createElement('Offers'));

    $temp = array_unique(array_column($file, '8'));
    $unique_arr = array_intersect_key($file, $temp);
    $file = $unique_arr;

    foreach ($file as $f){
        //var_dump($f);
        if(!array_key_exists(8, $f)){
            continue;
        }
        if ($f[8] !== 'NULL' && $f[9] > 20) {

            $name = mb_convert_encoding($f[5], "utf-8", "cp866");
            $name = str_replace('?','i', $name);
            $producer = mb_convert_encoding($f[6], "utf-8", "cp866");

            $Price_sp = $f[12];
            if ($Price_sp * 1.03 > $f[9]) {
                $price_end = $Price_sp;
            }else{
                $price_end = $f[9];
            }

            $Offer = $Offers->appendChild($dom->createElement('Offer'));
            $Offer->setAttribute("Code", $f[8]);
            $Offer->setAttribute("Name", $name);
            $Offer->setAttribute("Producer", $producer);
            $Offer->setAttribute("Tax", $f[7]);
            $Offer->setAttribute("Price", $price_end);
            $Offer->setAttribute("PriceReserve", $price_end);
            $Offer->setAttribute("Quantity", $f[11]);
            $Offer->setAttribute("Code1", $f[4]);
        }
    }

    $dom->formatOutput = true;
    $Offers = $dom->saveXML();

    $file_out_xml = $file_out . '.xml';
    $file_out_zip = $file_out . '.zip';

    $dom->save('/var/www/marketing.com/out/'.$file_out_xml);

    $zip = new ZipArchive();
    $filename = '/var/www/marketing.com/out/'.$file_out_zip;

    if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        exit("Невозможно открыть <$filename>\n");
        echo "<br>";
    }

    $zip->addFile('/var/www/marketing.com/out/'.$file_out_xml,$file_out_xml);
    $zip->close();

    $file = '/var/www/marketing.com/out/'.$file_out_zip;
    $remote_file = $file_out_zip;

    if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
        echo "Файл $file успешно загружен на сервер\n";
        echo "<br>";
    } else {
        echo "Не удалось загрузить $file на сервер\n";
        echo "<br>";
    }

    unlink($file_in);
}

ftp_close($conn_id);