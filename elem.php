<?php

require_once "./function.php";
require_once "autoload.php";

$html_elem = '';
$errors = '';
$fio = '';

$name = '';
$producer = '';
$tnved = '';
$mark = '';
$mnn = '';
$name_torg = '';
$form_prod = '';
$doza = '';
$nom_id = '';
$morion_id = '';
$barcode = '';
$nac = '';
$tax = '';
$gran_price = '';
$sum_com = '';
$amount_in_a_package = '';
$project_dl = '';
$checked = '';

$sp_type = '';
if (isset($_GET['sp_type'])){
    $sp_type = $_GET['sp_type'];
}

//var_dump($sp_type);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $field_search = "ID";
    $query_type = 'elem';

    $find = new GetData($sp_type,$id, $field_search, $query_type);
    $results = $find->result_data;

    //var_dump($results);
    foreach ($results as $result){
        if ($sp_type == 'podr') {
            $name = trim($result['apteka_name']);
            $firma = trim($result['firm_name']);
            $html_elem = "<div class=\"form-group col-md-6\">
                            <label for=\"inputEmail4\">Наименование</label>
                            <input type=\"text\" class=\"form-control\" id=\"inputEmail4\" value=\"$name\"
                                name=\"$name\" required>
                          </div>";
            //var_dump($name);
        }elseif ($sp_type == 'people'){
            $fio = trim($result['full_name']);
            $tel = $result['tel'];
            $birthday = $result['birthday'];
            $dismissed = $result['dismissed'];

            if($dismissed == 1){
                $errors = 'Уволен!!!';
            }
            
            $html_elem .= "<div class=\"form-group col-md-6\">
                            <label for=\"inputEmail4\">ФИО</label>
                            <input type=\"text\" class=\"form-control\" id=\"inputEmail4\" value=\"$fio\"
                                name=\"$fio\" required>
                          </div>";
            $html_elem .= "<div class=\"form-group col-md-2\">
                            <label for=\"inputEmail1\">Телефон</label>
                            <input type=\"number\" class=\"form-control\" id=\"inputEmail1\" value=\"$tel\"
                                name=\"$tel\" maxlength='10'>
                          </div>";
            $html_elem .= "<div class=\"form-group col-md-2\">
                            <label for=\"inputEmail1\">Дата рождения</label>
                            <input type=\"date\" class=\"form-control\" id=\"inputEmail1\" value=\"$birthday\"
                                name=\"$birthday\">
                          </div>";
        }
    }
}

if (isset($_POST['save']) || isset($_POST['copy'])) {

    if ($sp_type == 'podr') {

    } elseif ($sp_type == 'people'){
        $check = new CheckFields('ФИО', 'text',0,0,100, $_POST['fio']);
        $fio = $check->value;
        $errors .= $check->error;
    }
    var_dump($fio);



    if (empty($errors)){
        $element = ['id'=>$id,
                    'morion_id'=>(int) $morion_id,
                    'name'=>trim($name),
                    'producer'=>trim($producer),
                    'barcode'=>$barcode,
                    'tnved'=>$tnved,
                    'nac'=>(int) $nac,
                    'tax'=>(int) $tax,
                    'marketing'=>$marketing,
                    'gran_price'=>(float) $gran_price,
                    'sum_com'=>(float) $sum_com,
                    'mnn'=>$mnn,
                    'form_prod'=>$form_prod,
                    'doza'=>(float) $doza,
                    'name_torg'=>$name_torg,
                    'amount_in_a_package'=>(int) $amount_in_a_package,
                    'project_dl'=>$project_dl];

        if ($id == 0) {
            $method = 'new';
            //var_dump($element);
        }else {
            $method = 'update';
            //var_dump($element);
        }

        if (isset($_POST['copy'])){
            $element['id'] = 0;
            $method = 'new';
        }

        $save = new SaveToDB($element, $method);

        if ($method == 'new') {
            $id = $save->result;
        }
        header("location: ./elem.php?id=$id");
    }
}

if (isset($_POST['close'])) {
    //var_dump($_COOKIE['text_search']);
    if (isset($_COOKIE['text_search']) && (isset($_COOKIE['field_search']))){
        $str_search = './names.php?search='. $_COOKIE['text_search'] . '&field_search=' . $_COOKIE['field_search'] . '&submit_search=search';
    }else{
        $str_search = './names.php';
    }
    header("location: $str_search");
}

require_once "./elem.html";