<?php

require_once "autoload.php";
require_once "function.php";

//delete old files
array_map('unlink', glob("/var/www/marketing.com/out/dorado/*.*"));

$sp_type = 'podr';
$id = '';
$query_type = 'elem';
$field_search = '';
$arr_out[] = '';

$find = new GetData($sp_type,$id, $field_search, $query_type);
$results = $find->result_data;

//var_dump($results);


$ftp_server = '172.16.2.101';
$ftp_user_name = 'apteka';
$ftp_user_pass = '976179';

/*
$ftp_server = 'ftp.tabletki.ua';
$ftp_user_name = '1149';
$ftp_user_pass = 'c93541cb373b';
*/
$conn_id = ftp_connect($ftp_server);

$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
echo "login: $login_result\n";
echo "<br>";

ftp_pasv($conn_id, true);

foreach ($results as $result) {
    if ((!$result['mypharmacy_id']) || (!$result['saldo_path'])) {
        continue;
    }
    if ($result['mypharmacy_id'] == 0) {
        continue;
    }

    $file_in = str_replace("ftp", "dorado", $result['saldo_path']);

    if (!file_exists($file_in)) {
        continue;
    }

    $mypharmacy_id = $result['mypharmacy_id'];

    $file_name_out = './out/mypharmacy/' . $mypharmacy_id . '_' . date("Ymd") . date("His") . '.csv';
    $file_name_out_full = $file_name_out . '.csv';

    $read_file = new ReadFile($file_in);
    $file = $read_file->out;

    $temp = array_unique(array_column($file, '8'));
    $unique_arr = array_intersect_key($file, $temp);
    $file = $unique_arr;

    $arr_main = ['Code','Name','Producer','Price','PriceReserve','Quantity','Code1'];
    $file_name_out_ = fopen($file_name_out_full, 'w+');
    fputcsv($file_name_out_, $arr_main, ";");

    foreach ($file as $f) {
        //var_dump($f);
        if (!array_key_exists(8, $f)) {
            continue;
        }

        if ($f[8] !== 'NULL' && $f[9] > 20 && $f[11] >= 0.01) {

            $Code = $f[8];
            $Name = mb_convert_encoding($f[5], "utf-8", "cp866");
            $Name = str_replace('?', 'i', $Name);
            $Producer = mb_convert_encoding($f[6], "utf-8", "cp866");

            $Price_sp = $f[12];
            if ($Price_sp * 1.03 > $f[9]) {
                $price_end = $Price_sp;
            } else {
                $price_end = $f[9];
            }

            $Price = $price_end;
            $PriceReserve = $price_end;
            $Quantity = $f[11];
            $Code1 = $f[4];

            $arr_tmp = [$Code, $Name, $Producer, $Price, $PriceReserve, $Quantity, $Code1];
            fputcsv($file_name_out_, $arr_tmp, ";");
        }
    }
    fclose($file_name_out_);

    $file_out_zip = $file_out . '.zip';

    $zip = new ZipArchive();
    $filename = '/var/www/marketing.com/out/mypharmacy/'.$file_out_zip;

    if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        exit("Невозможно открыть <$filename>\n");
        echo "<br>";
    }

    $zip->addFile('/var/www/marketing.com/out/mypharmacy/'.$file_out_full,$file_out_full);
    $zip->close();

    $file = '/var/www/marketing.com/out/mypharmacy/'.$file_out_zip;
    $remote_file = $file_out_zip;

    if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
        echo "Файл $file успешно загружен на сервер\n";
        echo "<br>";
    } else {
        echo "Не удалось загрузить $file на сервер\n";
        echo "<br>";
    }

    //unlink($file_in);
}

ftp_close($conn_id);
