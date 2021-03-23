<?php

require_once "./function.php";
require_once "autoload.php";

$sp_type = '';
if (isset($_GET['sp_type'])){
    $sp_type = $_GET['sp_type'];
    setcookie('sp_type', $sp_type);
}else{$sp_type = $_COOKIE['sp_type'];}

//Выбор режима поиска
$select_options = ['podr'=>['apteka_name'=>'Наименование',
                            'firm_name'=>'Фирма'],
                   'MNN'=>['MNN'=>'MNN',
                            'sickness'=>'Заболевание'],
                   'names'=>['name'=>'Наименование',
                             'prod'=>'Производитель',
                             'id'=>'Код товара'],
                   'people'=>['full_name'=>'ФИО',
                              'tel'=>'Телефон'],
                   'marketing'=>['m_name'=>'Маркетинг'],
                   'providers'=>['name'=>'Поставщик',
                                'okpo'=>'ОКПО'],
                   'invoices'=>['apteka'=>'Аптека',
                                'provider'=>'Поставщик',
                                'invoice_number'=>'Номер накладной',
                                'sum'=>'Сумма'],
                   'users'=>['full_name'=>'Пользователь',
                            'email'=>'email']
                  ];

$html_select_options = '';

$i = 0;
foreach ($select_options[$sp_type] as $select_option) {
    $i++;
    if ($i == 1) {$html_select_options = "<option selected>$select_option</option>";
    }else{$html_select_options .= "<option>$select_option</option>";}
}

if (isset($_GET['submit_search'])) {
    $field = '';
    if (isset($_GET['search'])) {$text_search = $_GET['search'];
    }else{$text_search = '';}
    if (isset($_GET['field_search'])) {$field_search = $_GET['field_search'];
    }else{$field_search = '';}
    $sp_type = $_COOKIE['sp_type'];
    $query_type = 'list';

    $cols = ['id'=>'ID'];
    if ($sp_type == 'podr'){
        $cols += ['apteka.name'=>'Наименование',
                  'firm.name'=>'Фирма'];
    }elseif($sp_type == 'people'){
        $cols += ['full_name'=>'ФИО',
                 'tel'=>'Телефон'];
    }elseif($sp_type == 'marketing'){
        $cols += ['m_name'=>'Маркетинг',
                  'persent'=>'Процент',
                  'top'=>'ТОП',
                  'actual'=>'Актуальность'];
    }elseif ($sp_type == 'providers'){
        $cols += ['name'=>'Поставщик',
                  'okpo'=>'ОКПО'];
    }elseif ($sp_type == 'invoices'){
        $cols += ['apteka'=>'Аптека',
                  'provider'=>'Поставщик',
                  'invoice_number'=>'Номер',
                  'invoice_date'=>'Дата',
                  'invoice_sum'=>'Сумма',
                  'invoice_tax'=>'НДС',
                  'pay_date'=>'Оплата',
                  'invoice_status'=>'Статус'];
    }elseif ($sp_type == 'users'){
        $cols += ['full_name'=> 'Пользователь',
                  'email'=>'Email'];
    }
    $cols += ['modif'=>'Модификация'];
    //var_dump($cols);

    $find = new GetData($sp_type, $text_search, $field_search, $query_type);
    $res = $find->result_data;

    $result_tab = '';
    $id = 0;
    $role_id = $_COOKIE['role_id'];
    $apteka_id = $_COOKIE['apteka_id'];

    foreach($res as $r){
        //var_dump(array_keys($r));
        //var_dump($r);
        if($sp_type == 'invoices' && $role_id == 2){
            if($r['apteka_id'] !== $apteka_id){
                continue;
            }
        }
        $keys = array_keys($r);
        $result_tab .= '<tr>';
            foreach ($keys as $value) {
                if ($value == 'id' || $value == 'm_id' || $value == 'invoice_id'){
                    $id = (int) $r[$value];
                }
                $result_tab .= '<td>' . $r[$value] . '</td>';
            }

            $result_tab .= '<td>' . "<a href=/elem.php?id=$id&sp_type=$sp_type>изменить</a></td>";
        $result_tab .= '</tr>';
    }

    $count = count($res);
    setcookie('text_search', $text_search);
    setcookie('field_search', $field_search);
    setcookie('sp_type', $sp_type);

    //var_dump($_COOKIE['text_search']);
}

if (isset($_GET['submit_new'])) {
    header("location: ./elem.php?id=0&sp_type=$sp_type");
}

require_once "./spr.html";