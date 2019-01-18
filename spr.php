<?php

require_once "./function.php";
require_once "autoload.php";

$sp_type = '';
if (isset($_GET['sp_type'])){
    $sp_type = $_GET['sp_type'];
    setcookie('sp_type', $sp_type);
}else{
    $sp_type = $_COOKIE['sp_type'];
}

//var_dump($sp_type);

$select_options = ['podr'=>['apteka_name'=>'Наименование',
                            'firm_name'=>'Фирма'],
                   'MNN'=>['MNN'=>'MNN',
                            'sickness'=>'Заболевание'],
                   'names'=>['name'=>'Наименование',
                             'prod'=>'Производитель',
                             'id'=>'Код товара'],
                   'people'=>['full_name'=>'ФИО',
                              'tel'=>'Телефон']
                  ];
//var_dump($select_options);
$html_select_options = '';

$i = 0;
foreach ($select_options[$sp_type] as $select_option) {
    $i++;
    if ($i == 1) {
        $html_select_options = "<option selected>$select_option</option>";
    }else{
        $html_select_options .= "<option>$select_option</option>";
    }
}

if (isset($_GET['submit_search'])) {
    $field = '';
    $text_search = $_GET['search'];
    $field_search = $_GET['field_search'];
    $sp_type = $_COOKIE['sp_type'];

    $cols = ['id'=>'ID'];
    if ($sp_type == 'podr'){
        $cols += ['apteka.name'=>'Наименование',
                  'firm.name'=>'Фирма'];
    }elseif($sp_type == 'people'){
        $cols = ['full_name'=>'ФИО',
                 'tel'=>'Телефон'];
    }
    $cols += ['modif'=>'Модификация'];

    $find = new GetData($sp_type, $text_search, $field_search);
    //var_dump($find->result_data);
    $res = $find->result_data;

    $result_tab = '';
    foreach($res as $r){
        $result_tab .= '<tr>';
            $result_tab .= '<td>' . $r['id'] . '</td>';
            $result_tab .= '<td>' . $r['apteka_name'] . '</td>';
            $result_tab .= '<td>' . $r['firm_name'] . '</td>';
            $id = (int) $r['id'];
            $result_tab .= '<td>' . "<a href=/elem.php?id=$id&sp_type=podr>изменить</a></td>";
        $result_tab .= '</tr>';
    }


    $count = count($res);
    setcookie("text_search", $text_search);
    setcookie("field_search", $field_search);
    setcookie('sp_type', $sp_type);
    //var_dump($sp_type);
}

if (isset($_GET['submit_new'])) {
    header("location: ./elem.php?id=0");
}

require_once "./spr.html";