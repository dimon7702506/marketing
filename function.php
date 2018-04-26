<?php

require_once "./autoload.php";

function is_user_logged_in()
{
    return !empty($_SESSION['user_id']);
}

function log_in(int $id, string $login, string $user_name, int $user_role_id, $apteka_id) :void
{

    $_SESSION['user_id'] = (int) $id;
    $_SESSION['role_id'] = (int) $user_role_id;
    $_SESSION['login'] = $login;
    $_SESSION['name'] = $user_name;
    $_SESSION['apteka_id'] = (int) $apteka_id;

}

function get_user_name()
{
    if (!is_user_logged_in()) {
        return ' ';
    }
    return $_SESSION['name'];
}

function log_out()
{
    $_SESSION['user_id'] = null;
    $_SESSION['role_id'] = null;
    $_SESSION['apteka_id'] = null;
}

function export_names_base_to_file($fields)
{
    $text_search = '';
    $field_search = '';
    $find = new SearchFromNames($text_search, $field_search, $fields);
    $names = $find->result_data;
    array_walk($names, 'encode_names_CSV');

    $file = fopen("./out/names.csv", 'w+');

    foreach ($names as $name) {
        fputcsv($file, $name);
    }
    fclose($file);

    $download_file = "./out/names.csv";
    if (ob_get_level()) {
        ob_end_clean();
    }
    header('Content-Description: File Transfer');
    header('Content-Type: text/csv; charset=windows-1251');
    header('Content-Disposition: attachment; filename=' . basename($download_file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($download_file));
    readfile($download_file);

    $save = new SaveToDB('', 'update_modify');
}

function export_marketings_base_to_file()
{
    $text_search = '';
    $find = new ShowMarketings($text_search);
    $marketings = $find->result_data;
    array_walk($marketings, 'encode_marketing_CSV');

    $file = fopen("./out/marketings.csv", 'w+');
    foreach ($marketings as $marketing) {
        fputcsv($file, $marketing, ";");
    }
    fclose($file);

    $download_file = "./out/marketings.csv";
    if (ob_get_level()) {
        ob_end_clean();
    }
    header('Content-Description: File Transfer');
    header('Content-Type: text/csv; charset=windows-1251');
    header('Content-Disposition: attachment; filename=' . basename($download_file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($download_file));
    readfile($download_file);
}

function encode_marketing_CSV(&$value){
    $temp = $value['m_name'];
    $value['m_name'] = iconv("UTF-8", "Windows-1251", $temp);
}

function encode_names_CSV(&$value){

    $temp = $value['name'];
    $value['name'] = iconv("UTF-8", "Windows-1251", $temp);

    $temp = $value['producer'];
    $value['producer'] = iconv("UTF-8", "Windows-1251", $temp);

    $temp = $value['form_prod'];
    $value['form_prod'] = iconv("UTF-8", "Windows-1251", $temp);

    $temp = $value['name_torg'];
    $value['name_torg'] = iconv("UTF-8", "Windows-1251", $temp);
}