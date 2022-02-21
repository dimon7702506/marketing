<?php

require_once "./function.php";
require_once "autoload.php";

$sp_type = '';
$date_start = '';
$date_end = '';

if (isset($_GET['sp_type'])){
    $sp_type = $_GET['sp_type'];
    setcookie('sp_type', $sp_type);
}else{$sp_type = $_COOKIE['sp_type'];}

//Выбор режима поиска

if ($sp_type == 'routes_standart') {

    $s = '';
    if (isset($_GET['search'])) {$s = $_GET['search'];}

    $html_s = '<select id="inputState" class="form-control" style="margin-left: 10px" name="search">';
    $html_s .= '<option disabled>Выберите день недели</option>';
    $html_s .= '<option selected>' . $s . '</option>';
    $html_s .= "<option></option>";

    $find_list = new GetData('days', '', '', 'list');
    $lists = $find_list->result_data;

    foreach ($lists as $list) {$html_s .= "<option>$list[name]</option>";}
    $html_s .= '</select>';

}elseif ($sp_type == 'cash_day'){

    $s = '';
    if (isset($_GET['search'])) {$s = $_GET['search'];}

    if (get_role_id() == 1) {
        $html_s = '<label for="inputState" style="padding-right: 10px; padding-left: 10px">Аптека:</label>';
        $html_s .= '<select id="inputState" class="form-control" style="margin-left: 10px" name="search">';
        //$html_s .= '<option disabled>Аптека</option>';
        $html_s .= '<option selected>' . $s . '</option>';
        $html_s .= "<option></option>";

        $find_list = new GetData('podr', '', '', 'list');
        $lists = $find_list->result_data;

        foreach ($lists as $list) {$html_s .= "<option>$list[name]</option>";}
        
        $html_s .= '</select>';
    }

    if(isset($_GET['date_start'])) {$date_start = $_GET['date_start'];}
    else{$date_start = date("Y-m-d", strtotime('first day of this month'));}
    if(isset($_GET['date_end'])) {$date_end = $_GET['date_end'];}
    else{$date_end = date("Y-m-d");}

    $html_s .= '<div class="form-group mx-sm-3">';
    $html_s .= '<label for="inputState" style="padding-right: 10px; padding-left: 10px">Период:</label>';
    $html_s .= '<input type="date" class="form-control" id="formGroupExampleInput" name="date_start" value='.$date_start.'>';
    $html_s .= '<label for="inputState" style="padding-right: 10px; padding-left: 10px">-</label>';
    $html_s .= '<input type="date" class="form-control" id="formGroupExampleInput" name="date_end" value='.$date_end.'>';
    $html_s .= '</div>';

}else{

    $s = '';
    if (isset($_GET['search'])) {$s = 'value = ' . $_GET['search'] . ';';}

    $html_s = '<div class="form-group mx-sm-3">';
    $html_s .= '<label for="formGroupExampleInput" class="sr-only">Password</label>';
    $html_s .= '<input type="text" class="form-control" id="formGroupExampleInput" name="search" placeholder="Поиск"
                    style="width: 500px;' . $s . '>';
    $html_s .= '</div>';

    if ($sp_type == 'invoices'){
        if(isset($_GET['date_start'])) {$date_start = $_GET['date_start'];}
        else{$date_start = date("Y-m-d");}
        if(isset($_GET['date_end'])) {$date_end = $_GET['date_end'];}
        else{$date_end = date("Y-m-d");}

        $html_s .= '<div class="form-group mx-sm-3">';
        $html_s .= '<label for="inputState" style="padding-right: 10px; padding-left: 10px">Период:</label>';
        $html_s .= '<input type="date" class="form-control" id="formGroupExampleInput" name="date_start" value='.$date_start.'>';
        $html_s .= '<label for="inputState" style="padding-right: 10px; padding-left: 10px">-</label>';
        $html_s .= '<input type="date" class="form-control" id="formGroupExampleInput" name="date_end" value='.$date_end.'>';
        $html_s .= '</div>';
    }
}

$html_button_1C = '';
if ($sp_type == 'invoices' || $sp_type == 'cash_day') {
    if (get_role_id() == 1) {
        $html_button_1C = '<button type="submit" class="btn btn-outline-success my-2 mark-button"
            style="background-color: #3d713d; color: #ffffff; margin-left: 15px" name="submit_1C"
            value="1С">Передать в 1С</button>';
    }
}

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
                                'invoice_status'=>'Статус',
                                'invoice_number'=>'Номер накладной',
                                'sum'=>'Сумма'],
                   'users'=>['full_name'=>'Пользователь',
                            'email'=>'email'],
                   'routes'=>['apteka_name'=>'Аптека'],
                   'routes_standart'=>['day'=>'День недели',
                                       'apteka_name'=>'Аптека'],
                   'destination'=>['name'=>'Наименование'],
                   'cash_day'=>['apteka'=>'Аптека']];

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
        $cols += ['apteka_id'=>'Код',
                  'apteka'=>'Аптека',
                  'provider'=>'Поставщик',
                  'invoice_number'=>'Номер',
                  'invoice_date'=>'Дата',
                  'invoice_sum'=>'Сумма',
                  'invoice_status'=>'Статус'];
    }elseif ($sp_type == 'users'){
        $cols += ['full_name'=> 'Пользователь',
                  'email'=>'Email'];
    }elseif ($sp_type == 'routes'){
        $cols += [/*'day'=> 'День недели',*/
                'route_date'=>'Дата',
                'apteka_name'=>'Аптека',
                'destination_name'=>'Куда',
                'create_date'=>'Дата подачи заявки'];
    }elseif ($sp_type == 'destination'){
        $cols += ['route'=>'Наименование'];
    }elseif ($sp_type == 'cash_day'){
        $cols += ['apteka_id'=>'Код',
                  'date'=>'Дата',
                  'apteka'=>'Аптека',
                  'error_check'=>'Ошибка'];
    }elseif ($sp_type == 'routes_standart'){
        $cols += ['day'=> 'День недели',
                  'destination'=>'Аптека',
                  'numb'=>'Порядок'];
    }
    $cols += ['modif'=>'Модификация'];

    $find = new GetData($sp_type, $text_search, $field_search, $query_type, $date_start, $date_end);
    $res = $find->result_data;

    $result_tab = '';
    $id = 0;

    foreach($res as $r){
        //var_dump(array_keys($r));
        //var_dump_($r);
        if (isset($r['apteka_id'])) {
            if ($sp_type == 'invoices' || $sp_type == 'cash_day'){
                if (get_role_id() == 2) {if ($r['apteka_id'] !== get_apteka_id()) {continue;}}
            }
        }
        $keys = array_keys($r);
        $result_tab .= '<tr>';
            foreach ($keys as $value) {
                if ($value == 'id' || $value == 'm_id' || $value == 'invoice_id'){$id = (int) $r[$value];}
                $result_tab .= '<td>' . $r[$value] . '</td>';
            }
            $result_tab .= '<td>' . "<a href=/elem_pre.php?id=$id&sp_type=$sp_type>изменить</a></td>";
        $result_tab .= '</tr>';
    }

    $count = count($res);

    setcookie('text_search', $text_search);
    setcookie('field_search', $field_search);
    setcookie('sp_type', $sp_type);
}

if (isset($_GET['submit_new'])) {
    if ($sp_type == 'cash_day') {header("location: ./elem_cash.php?id=0");}
    else {header("location: ./elem.php?id=0&sp_type=$sp_type");}
}

if (isset($_GET['submit_1C'])){
    if ($sp_type == 'invoices'){
        invoise_to_1C();
    }elseif ($sp_type == 'cash_day'){
        //$start = date("Y-m-d", strtotime('- month', $date_end));
        invoise_to_1C_cash_csv($date_start, $date_end);
    }
}

require_once "./spr.html";