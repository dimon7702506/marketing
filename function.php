<?php

require_once "./autoload.php";

function is_user_logged_in()
{
    if(empty($_SESSION['user_id'])){
        log_out();
        header('location: ./login.html');
    }
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

// ================Сумма прописью
function sum2text_ua($num) {
    $num = trim(preg_replace('~s+~s', '', $num)); // отсекаем пробелы
    if (preg_match("/, /", $num)) {
        $num = preg_replace("/, /", ".", $num);
    } // преобразует запятую
    if (is_numeric($num)) {
        $num = round($num, 2); // Округляем до сотых (копеек)
        $num_arr = explode(".", $num);
        $amount = $num_arr[0]; // переназначаем для удобства, $amount - сумма без копеек
        if (strlen($amount) <= 3) {
            $res = implode(" ", Triada($amount)) . Currency($amount);
        } else {
            $amount1 = $amount;
            while (strlen($amount1) >= 3) {
                $temp_arr[] = substr($amount1, -3); // засовываем в массив по 3
                $amount1 = substr($amount1, 0, -3); // уменьшаем массив на 3 с конца
            }
            if ($amount1 != '') {
                $temp_arr[] = $amount1;
            } // добавляем то, что не добавилось по 3
            $i = 0;
            foreach ($temp_arr as $temp_var) { // переводим числа в буквы по 3 в массиве
                $i++;
                if ($i == 3 || $i == 4) { // миллионы и миллиарды мужского рода, а больше миллирда вам все равно не заплатят
                    if ($temp_var == '000') {

                        $temp_res[] = '';
                    } else {
                        $temp_res[] = implode(" ", Triada($temp_var, 1)) . GetNum($i, $temp_var);
                    } # if
                } else {
                    if ($temp_var == '000') {
                        $temp_res[] = '';
                    } else {
                        $temp_res[] = implode(" ", Triada($temp_var)) . GetNum($i, $temp_var);
                    } # if
                } # else
            } # foreach
            $temp_res = array_reverse($temp_res); // разворачиваем массив
            $res = implode(" ", $temp_res) . Currency($amount);
        }
        if (!isset($num_arr[1]) || $num_arr[1] == '') {
            $num_arr[1] = '00';
        }
        return $res . ', ' . $num_arr[1] . ' коп.';
    } # if
}

function Triada($amount, $case = null) {
    global $_1_2, $_1_19, $des, $hang; // объявляем массив переменных
    $count = strlen($amount);
    for ($i = 0; $i < $count; $i++) {
        $triada[] = substr($amount, $i, 1);
    }
    $triada = array_reverse($triada); // разворачиваем массив для операций
    if (isset($triada[1]) && $triada[1] == 1) { // строго для 10-19
        $triada[0] = $triada[1] . $triada[0]; // Объединяем в единицы
        $triada[1] = ''; // убиваем десятки
        $triada[0] = $_1_19[$triada[0]]; // присваиваем
    } else { // а дальше по обычной схеме
        if (isset($case) && ($triada[0] == 1 || $triada[0] == 2)) { // если требуется м.р.
            $triada[0] = $_1_2[$triada[0]]; // единицы, массив мужского рода
        } else {
            if ($triada[0] != 0) {
                $triada[0] = $_1_19[$triada[0]];
            } else {
                $triada[0] = '';
            } // единицы
        } # if
        if (isset($triada[1]) && $triada[1] != 0) {
            $triada[1] = $des[$triada[1]];
        } else {
            $triada[1] = '';
        } // десятки
    }
    if (isset($triada[2]) && $triada[2] != 0) {
        $triada[2] = $hang[$triada[2]];
    } else {
        $triada[2] = '';
    } // сотни
    $triada = array_reverse($triada); // разворачиваем массив для вывода
    foreach ($triada as $triada_) { // вычищаем массив от пустых значений
        if ($triada_ != '') {
            $triada1[] = $triada_;
        }
    } # foreach
    return $triada1;
}

function Currency($amount) {
    global $namecurr; // объявляем масиив переменных
    $last2 = substr($amount, -2); // последние 2 цифры
    $last1 = substr($amount, -1); // последняя 1 цифра
    $last3 = substr($amount, -3); //последние 3 цифры
    if ((strlen($amount) != 1 && substr($last2, 0, 1) == 1) || $last1 >= 5 || $last3 == '000') {
        $curr = $namecurr[3];
    } // от 10 до 19
    else if ($last1 == 1) {
        $curr = $namecurr[1];
    } // для 1-цы
    else {
        $curr = $namecurr[2];
    } // все остальные 2, 3, 4
    return ' ' . $curr;
}

function GetNum($level, $amount) {
    global $nametho, $namemil, $namemrd; // объявляем массив переменных
    if ($level == 1) {
        $num_arr = null;
    } else if ($level == 2) {
        $num_arr = $nametho;
    } else if ($level == 3) {
        $num_arr = $namemil;
    } else if ($level == 4) {
        $num_arr = $namemrd;
    } else {
        $num_arr = null;
    }
    if (isset($num_arr)) {
        $last2 = substr($amount, -2);
        $last1 = substr($amount, -1);
        if ((strlen($amount) != 1 && substr($last2, 0, 1) == 1) || $last1 >= 5) {
            $res_num = $num_arr[3];
        } // 10-19
        else if ($last1 == 1) {
            $res_num = $num_arr[1];
        } // для 1-цы
        else {
            $res_num = $num_arr[2];
        } // все остальные 2, 3, 4
        return ' ' . $res_num;
    } # if
}

$_1_2[1] = "один";
$_1_2[2] = "два";

$_1_19[1] = "одна";
$_1_19[2] = "дві";
$_1_19[3] = "три";
$_1_19[4] = "чотири";
$_1_19[5] = "п'ять";
$_1_19[6] = "шість";
$_1_19[7] = "сім";
$_1_19[8] = "вісім";
$_1_19[9] = "дев'ять";
$_1_19[10] = "десять";

$_1_19[11] = "одинадцять";
$_1_19[12] = "дванадцять";
$_1_19[13] = "тринадцять";
$_1_19[14] = "чотирнадцять";
$_1_19[15] = "п'ятнадцять";
$_1_19[16] = "шістнадцять";
$_1_19[17] = "сімнадцять";
$_1_19[18] = "вісімнадцять";
$_1_19[19] = "дев'ятнадцять";


$des[2] = "двадцять";
$des[3] = "тридцять";
$des[4] = "сорок";
$des[5] = "п'ятдесят";
$des[6] = "шістдесят";
$des[7] = "сімдесят";
$des[8] = "вісімдесят";
$des[9] = "дев'яносто";

$hang[1] = "сто";
$hang[2] = "двісті";
$hang[3] = "триста";
$hang[4] = "чотириста";
$hang[5] = "п'ятсот";
$hang[6] = "шістсот";
$hang[7] = "сімсот";
$hang[8] = "вісімсот";
$hang[9] = "дев'ятьсот";

$namecurr[1] = "гривня"; // 1
$namecurr[2] = "гривні"; // 2, 3, 4
$namecurr[3] = "гривень"; // >4

$nametho[1] = "тисяча"; // 1
$nametho[2] = "тисячі"; // 2, 3, 4
$nametho[3] = "тисяч"; // >4

$namemil[1] = "мільйон"; // 1
$namemil[2] = "мільйона"; // 2, 3, 4
$namemil[3] = "мільйонів"; // >4

$namemrd[1] = "мільярд"; // 1
$namemrd[2] = "мільярда"; // 2, 3, 4
$namemrd[3] = "мільярдів"; // >4
//=====================================