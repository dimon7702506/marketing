<?php

require_once "./autoload.php";

function is_user_logged_in()
{
    return !empty($_SESSION['user_id']);
}

function log_in(int $id, string $login, string $user_name) :void
{
    $_SESSION['user_id'] = (int) $id;
    $_SESSION['login'] = $login;
    $_SESSION['name'] = $user_name;
}

function get_user_name()
{
    if (!is_user_logged_in()) {
        return ' ';
    }
    return /*$_SESSION['user_id'] . " " .*/ $_SESSION['name'];
}

function log_out()
{
    $_SESSION['user_id'] = null;
}

function export_names_base_to_file($fields)
{
    $text_search = '';
    $field_search = '';
    $id_to_update = '';
    $find = new SearchFromNames($text_search, $field_search, $fields);
    $names = $find->result_data;

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
    header('Content-Type: application/octet-stream');
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

    $file = fopen("./out/marketings.csv", 'w+');

    foreach ($marketings as $marketing) {
        fputcsv($file, $marketing);
    }
    fclose($file);

    $download_file = "./out/marketings.csv";
    if (ob_get_level()) {
        ob_end_clean();
    }
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($download_file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($download_file));
    readfile($download_file);
}
