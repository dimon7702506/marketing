<?php

require_once "./function.php";
require_once "autoload.php";

is_user_logged_in();

$html_elem = '';
$errors = '';
$fio = '';
$sp_type = '';
$apteka = '';
$invoice_status = '';
$visible = '';

if (isset($_GET['sp_type'])){$sp_type = $_GET['sp_type'];}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $field_search = "ID";
    $query_type = 'elem';

    $find = new GetData($sp_type,$id, $field_search, $query_type);
    $results = $find->result_data;

    //var_dump($results);

    if ($sp_type == 'podr') {
        $fields = ['apteka' => ['field_name' => 'Аптека',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 100,
                                    'str_num' => 1,
                                    'col' => 4,
                                    'required' => 'required',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'firm_name' => ['field_name' => 'Фирма',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 50,
                                    'str_num' => 1,
                                    'col' => 4,
                                    'required' => 'required',
                                    'form_type' => 'select',
                                    'related_table' => 'firm',
                                    'key' => 'firm_id'],
                    'zav_name' => ['field_name' => 'Заведующая',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 100,
                                    'str_num' => 3,
                                    'col' => 4,
                                    'required' => 'required',
                                    'related_table' => 'people',
                                    'form_type'=>'select'],
                    'adres' => ['field_name' => 'Адрес',
                                'type' => 'text',
                                'min' => 0,
                                'max' => 0,
                                'length' => 200,
                                'str_num' => 1,
                                'col' => 6,
                                'required' => 'required',
                                'related_table' => '',
                                'form_type'=>'input'],
                    'tel' => ['field_name' => 'Телефон',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 13,
                            'str_num' => 1,
                            'col' => 2,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type'=>'input'],
                    'email' => ['field_name' => 'Email',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 2,
                            'col' => 4,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type'=>'input'],
                    'db_server' => ['field_name' => 'DB server',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 15,
                            'str_num' => 3,
                            'col' => 2,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type'=>'input'],
                    'db_name' => ['field_name' => 'DB name',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 15,
                            'str_num' => 3,
                            'col' => 2,
                            'required' => '',
                            'related_table' => '',
                            'form_type'=>'input'],
                    'db_user' => ['field_name' => 'DB user',
                                'type' => 'text',
                                'min' => 0,
                                'max' => 0,
                                'length' => 20,
                                'str_num' => 3,
                                'col' => 2,
                                'required' => '',
                                'related_table' => '',
                                'form_type'=>'input'],
                    'db_password' => ['field_name' => 'DB password',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 20,
                                    'str_num' => 3,
                                    'col' => 2,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'SQL_version' => ['field_name' => 'SQL',
                                    'type' => 'number',
                                    'min' => 2005,
                                    'max' => 2020,
                                    'length' => 0,
                                    'str_num' => 3,
                                    'col' => 2,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'TM_version' => ['field_name' => 'TM version',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 4,
                                    'str_num' => 3,
                                    'col' => 2,
                                    'required' => '',
                                    'form_type'=>'input',
                                    'related_table' => ''],
                    'google_login' => ['field_name' => 'Google login',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 50,
                                    'str_num' => 3,
                                    'col' => 2,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'google_password' => ['field_name' => 'Google password',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 50,
                                    'str_num' => 3,
                                    'col' => 2,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'saldo_path' => ['field_name' => 'Saldo path',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 100,
                                    'str_num' => 3,
                                    'col' => 4,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'tabletki_id' => ['field_name' => 'Код tabletki.ua',
                                    'type' => 'number',
                                    'min' => 0,
                                    'max' => 99999,
                                    'length' => 0,
                                    'str_num' => 3,
                                    'col' => 2,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'liki24_id' => ['field_name' => 'Код liki24',
                                    'type' => 'number',
                                    'min' => 0,
                                    'max' => 99999,
                                    'length' => 0,
                                    'str_num' => 3,
                                    'col' => 2,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'mypharmacy_id' => ['field_name' => 'Код Моя Аптека',
                                    'type' => 'number',
                                    'min' => 0,
                                    'max' => 99999,
                                    'length' => 0,
                                    'str_num' => 3,
                                    'col' => 2,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'last_update' => ['field_name' => 'Обновление',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 50,
                                    'str_num' => 3,
                                    'col' => 2,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input']];
    }elseif ($sp_type == 'people') {
        $fields = ['full_name' => ['field_name' => 'ФИО',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 100,
                                    'str_num' => 1,
                                    'col' => 6,
                                    'required' => 'required',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'tel' => ['field_name' => 'Телефон',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 999999999,
                                    'length' => 13,
                                    'str_num' => 1,
                                    'col' => 2,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'tm_id' => ['field_name' => 'Код в ТМ',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 100,
                                    'str_num' => 1,
                                    'col' => 6,
                                    'required' => 'required',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'apteka' => ['field_name' => 'Аптека',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 100,
                                    'str_num' => 1,
                                    'col' => 6,
                                    'required' => 'required',
                                    'related_table' => 'apteka',
                                    'form_type'=>'select',
                                    'key' => 'apteka_id']];
    }elseif ($sp_type == 'marketing') {
        $fields = ['m_name' => ['field_name' => 'Маркетинг',
                                   'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 100,
                                    'str_num' => 1,
                                    'col' => 6,
                                    'required' => 'required',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'persent' => ['field_name' => 'Процент',
                                    'type' => 'number',
                                    'min' => 0,
                                    'max' => 100,
                                    'length' => 3,
                                    'str_num' => 2,
                                    'col' => 1,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'summ' => ['field_name' => 'Сумма бонуса',
                                    'type' => 'number',
                                    'min' => 0,
                                    'max' => 1000000,
                                    'length' => 3,
                                    'str_num' => 1,
                                    'col' => 2,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'top' => ['field_name' => 'TOP',
                                    'type' => 'number',
                                    'min' => 0,
                                    'max' => 1,
                                    'length' => 0,
                                    'str_num' => 1,
                                    'col' => 1,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    'actual' => ['field_name' => 'Актуальность',
                                    'type' => 'number',
                                    'min' => 0,
                                    'max' => 1,
                                    'length' => 0,
                                    'str_num' => 1,
                                    'col' => 1,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input']];
    }elseif ($sp_type == 'providers'){
        $fields = ['name' => ['field_name' => 'Поставщик',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 6,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type'=>'input'],
                    'okpo'=> ['field_name' => 'ОКПО',
                            'type' => 'number',
                            'min' => 0,
                            'max' => 99999999,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 6,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type'=>'input'],
                    'visible'=> ['field_name' => 'Видимость ',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 3,
                            'str_num' => 1,
                            'col' => 6,
                            'required' => '',
                            'related_table' => '',
                            'form_type'=>'checkbox']];
    }elseif ($sp_type == 'invoices') {
         $fields = ['apteka' => ['field_name' => 'Аптека',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 4,
                            'required' => 'required',
                            'related_table' => 'apteka',
                            'form_type' => 'select',
                            'key' => 'apteka_id'],
            'provider' => ['field_name' => 'Поставщик',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 4,
                            'required' => 'required',
                            'related_table' => 'providers',
                            'form_type' => 'select',
                            'key' => 'provider_id'],
            'invoice_number' => ['field_name' => 'Номер накладной',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 2,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type' => 'input',
                            'key' => ''],
            'invoice_date' => ['field_name' => 'Дата накладной',
                            'type' => 'date',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 2,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type' => 'input',
                            'key' => ''],
            'invoice_sum' => ['field_name' => 'Сумма',
                            'type' => 'number',
                            'min' => 0,
                            'max' => 999999.99,
                            'length' => 100,
                            'str_num' => 2,
                            'col' => 2,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type' => 'input',
                            'key' => ''],
            'invoice_tax' => ['field_name' => 'НДС',
                            'type' => 'number',
                            'min' => 0,
                            'max' => 999999.99,
                            'length' => 0,
                            'str_num' => 2,
                            'col' => 2,
                            'required' => '',
                            'related_table' => '',
                            'form_type' => 'input',
                            'key' => ''],
             /*
            'pay_date' => ['field_name' => 'Дата оплаты',
                            'type' => 'date',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 2,
                            'col' => 2,
                            'required' => '',
                            'related_table' => '',
                            'form_type' => 'input',
                            'key' => ''],
             */
            'invoice_status' => ['field_name' => 'Статус',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 2,
                            'col' => 2,
                            'required' => 'required',
                            'related_table' => 'invoice_status',
                            'form_type' => 'select',
                            'key' => 'invoice_status_id'],

            'note' => ['field_name' => 'Примечание',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 2000,
                            'required' => 'required',
                            'str_num' => 3,
                            'col' => 12,
                            'related_table' => '',
                            'form_type' => 'textarea',
                            'key' => '']];
    }elseif ($sp_type == 'users') {
        $fields = ['full_name' => ['field_name' => 'ФИО',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 5,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type' => 'input',
                            'key' => ''],
                    'email'=> ['field_name' => 'Email',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 5,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type' => 'input',
                            'key' => ''],
                    'role_id'=> ['field_name' => 'Роль',
                            'type' => 'number',
                            'min' => 1,
                            'max' => 2,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 1,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type' => 'input',
                            'key' => ''],
                    'password'=> ['field_name' => 'Password',
                            'type' => 'text',
                            'min' => 1,
                            'max' => 2,
                            'length' => 100,
                            'str_num' => 2,
                            'col' => 4,
                            'required' => '',
                            'related_table' => '',
                            'form_type' => 'input',
                            'key' => ''],
                    'password_hash'=> ['field_name' => 'Password hash',
                            'type' => 'text',
                            'min' => 1,
                            'max' => 2,
                            'length' => 300,
                            'str_num' => 2,
                            'col' => 7,
                            'required' => '',
                            'related_table' => '',
                            'form_type' => 'input',
                            'key' => '']];
    }elseif ($sp_type == 'routes') {
        $fields = ['route_date' => ['field_name' => 'Дата',
                            'type' => 'date',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 2,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type' => 'input',
                            'key' => ''],
                    'apteka' => ['field_name' => 'Аптека',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 4,
                            'required' => 'required',
                            'related_table' => 'apteka',
                            'form_type' => 'select',
                            'key' => 'apteka_id'],
                    'destination' => ['field_name' => 'Куда',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 4,
                            'required' => 'required',
                            'related_table' => 'destination',
                            'form_type' => 'select',
                            'key' => 'destination_id']];
    }elseif ($sp_type == 'destination'){
        $fields = ['name' => ['field_name' => 'Пункт назначения',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 50,
                            'str_num' => 1,
                            'col' => 4,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type'=>'input'],
                    'adres' => ['field_name' => 'Адрес',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 200,
                            'str_num' => 1,
                            'col' => 8,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type'=>'input']];
    }elseif ($sp_type == 'routes_standart') {
        $fields = ['day' => ['field_name' => 'День недели',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 2,
                            'required' => 'required',
                            'related_table' => 'days',
                            'form_type' => 'select',
                            'key' => 'day_id'],
                    'destination' => ['field_name' => 'Куда',
                            'type' => 'text',
                            'min' => 0,
                            'max' => 0,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 4,
                            'required' => 'required',
                            'related_table' => 'destination',
                            'form_type' => 'select',
                            'key' => 'destination_id'],
                    'numb' => ['field_name' => 'Порядок',
                            'type' => 'number',
                            'min' => 10,
                            'max' => 10000,
                            'length' => 100,
                            'str_num' => 1,
                            'col' => 2,
                            'required' => 'required',
                            'related_table' => '',
                            'form_type' => 'input',
                            'key' => '']];
    }

    if (empty($results)){
        $res = [];
        foreach ($fields as $key=>$val){$res += [$key => ''];}
        array_push($results, $res);
        if ($sp_type == 'invoices'){

            $new_apteka = new GetData('podr',$_COOKIE['apteka_id'], 'id', "elem");
            $new_results = $new_apteka->result_data;
            foreach ($new_results as $new_result) {$apteka = $new_result['apteka'];}

            $new_status = new GetData('invoice_status', 1, 'id', "elem");
            $new_results_statuses = $new_status->result_data;
            foreach ($new_results_statuses as $new_results_status) {$invoice_status = $new_results_status['name'];}
        }
    }

    foreach ($results as $result){
        if ($sp_type == 'podr') {
            $apteka = trim($result['apteka']);
            $firm = $result['firm_name'];
            $zav = $result['zav_name'];
        }elseif ($sp_type == 'people'){
            $fio = trim($result['full_name']);
            $tel = $result['tel'];
            $birthday = $result['birthday'];
            $tm_id = $result['tm_id'];
            if (!array_key_exists('dismissed', $result)) {$result += ['dismissed' => 0];}
            $dismissed = $result['dismissed'];
            $apteka = $result['apteka'];
            if($dismissed == 1){$errors = 'Уволен!!!';}
        }elseif ($sp_type == 'providers'){
            $provider = trim($result['name']);
            $visible = trim($result['visible']);
        }elseif ($sp_type == 'invoices'){
            if (!$apteka){$apteka = $result['apteka'];}
            $provider = $result['provider'];
            if (!$invoice_status){$invoice_status = $result['invoice_status'];}
        }elseif ($sp_type == 'invoice_status'){$invoice_status = $result['invoice_status'];
        }elseif ($sp_type == 'routes'){
            $apteka = $result['apteka'];
            if(!isset($_GET['apteka'])){
                $apt_id = 2;
                if ($_COOKIE['apteka_id'] > 0){$apt_id = $_COOKIE['apteka_id'];}
                $find = new GetData('podr', $apt_id, 'id', 'elem');
                $results = $find->result_data;
                $apteka = $results[0]['apteka'];
            }
            $destination = $result['destination'];
        }elseif ($sp_type == 'destination') {
            $destination = trim($result['name']);
            $adress = trim($result['adres']);
        }elseif ($sp_type == 'routes_standart'){
            $day = $result['day'];
            $numb = $result['numb'];
            $destination = $result['destination'];
        }

        foreach ($fields as $key => $f) {
            //var_dump($key);
            $html_elem .= '<div class="form-group col-md-' . $f['col'] . '">
                                <label for="inputEmail4">' . $f['field_name'] . ' </label>';
            if ($f['form_type'] == 'input') {
                $step = '';
                if ($f['type'] == 'number'){
                    $step = 'step = "any" pattern="[0-9]+([\.][0-9]+)?"';
                }
                $html_elem .= '<input type="' . $f['type'] . '"' . $step . 'class="form-control" id="inputEmail1" value="' . $result[$key] . '"
                                name="' . $key . '" ' . $f['required'] . '>';
            }elseif ($f['form_type'] == 'textarea') {
                $html_elem .= '<textarea class="form-control" id="text" name="' . $key . '" rows = 10>'
                    . $result[$key] . '</textarea>';
            }elseif ($f['form_type'] == 'checkbox') {
                $tmp = $result[$key];

                if ($tmp == 'on') {$tmp = 'checked';}
                else {$tmp = '';}

                $html_elem .= '<input type="checkbox"  id="inputZip" name="'.$key.'"' . $tmp .'>';
            }elseif ($f['form_type'] == 'select'){
                $html_elem .= '<select id="inputState" class="form-control" name="' . $key . '">
                                <option selected>';

                if($key == 'firm_name') {
                    $html_elem .= $firm;
                    $sp_type_list = 'firm';
                }elseif ($key == 'zav_name'){
                    $html_elem .= $zav;
                    $sp_type_list = 'people';
                }elseif ($key == 'apteka_name' || $key == 'apteka'){
                    $html_elem .= $apteka;
                    $sp_type_list = 'podr';
                }elseif ($key == 'provider'){
                    $html_elem .= $provider;
                    $sp_type_list = 'providers';
                }elseif ($key == 'invoice_status'){
                    $html_elem .= $invoice_status;
                    $sp_type_list = 'invoice_status';
                }elseif ($key == 'day'){
                    $html_elem .= $day;
                    $sp_type_list = 'days';
                }elseif ($key == 'destination'){
                    $html_elem .= $destination;
                    $sp_type_list = 'destination';
                }

                $html_elem .= '</option>
                                <option></option>';

                $find_list = new GetData($sp_type_list,'','', 'list');
                $lists = $find_list->result_data;

                foreach ($lists as $list) {
                    $html_elem .= "<option>$list[name]</option>";
                }
                $html_elem .= '</select>';
            }
            $html_elem .='</div>';
            //var_dump($html_elem);
        }
    }
}

$html_btn_copy = '';
if (get_role_id() == 1){
    $html_btn_copy = '<button type="submit" class="btn btn-primary" name="copy" style="margin-left: 15px">Копировать</button>';
}

if (isset($_POST['save']) || isset($_POST['copy'])) {

    $element = [];
    $del_arg = [];

        foreach ($fields as $key => $f) {

            if (isset($_POST[$key])) {
                $check = new CheckFields($f['field_name'], $f['type'], $f['min'], $f['max'], $f['length'],
                    $_POST[$key], $f['required']);
                $val = $check->value;
                //var_dump_($key);
            }

            if ($f['type'] == 'number') {
                if ($val == '') {$val = 0;}
            }
            elseif ($f['type'] == 'text'){$val = trim($val);}
            elseif ($f['type'] == 'date'){
                if ($val == '') {$val = NULL;}
            }

            $element += [$key=>$val];

            if($f['related_table'] == 'firm'){
                $find_id = new GetData('firm', $element['firm_name'],'firm.name', 'id');
                $related_id = $find_id->result_data;
                $element += ['firm_id'=> (int) $related_id[0]['id']];
                array_push($del_arg,'firm_name');
            }
            if($f['related_table'] == 'people'){
                $find_id = new GetData('people', $element['zav_name'],'full_name', 'id');
                $related_id = $find_id->result_data;
                $element += ['zav_id'=> (int) $related_id[0]['id']];
                array_push($del_arg,'zav_name');
            }
            if($f['related_table'] == 'apteka'){
                $find_id = new GetData('podr', $element['apteka'],'name', 'id');
                $related_id = $find_id->result_data;
                $element += ['apteka_id'=> (int) $related_id[0]['id']];
                array_push($del_arg,'apteka_name');
                array_push($del_arg,'apteka');
            }
            if($f['related_table'] == 'providers'){
                $find_id = new GetData('providers', $element['provider'],'name', 'id');
                $related_id = $find_id->result_data;
                $element += ['provider_id'=> (int) $related_id[0]['id']];
                array_push($del_arg,'provider');

                $element += ['zav_id'=> (int) $related_id[0]['id']];
            }
            if($f['related_table'] == 'invoice_status'){
                $find_id = new GetData('invoice_status', $element['invoice_status'],'name', 'id');
                $related_id = $find_id->result_data;
                $element += ['invoice_status_id'=> (int) $related_id[0]['id']];
                array_push($del_arg,'invoice_status');
            }
            if($f['related_table'] == 'days'){
                $find_id = new GetData('days', $element['day'],'name', 'id');
                $related_id = $find_id->result_data;
                $d_id = 0;
                if (!empty($related_id)){$d_id = (int) $related_id[0]['id'];}
                $element += ['day_id'=> $d_id];
                array_push($del_arg,'day');
            }
            if($f['related_table'] == 'destination'){
                $find_id = new GetData('destination', $element['destination'],'name', 'id');
                $related_id = $find_id->result_data;
                $dst_id = 0;
                if (!empty($related_id)){$dst_id = (int) $related_id[0]['id'];}
                $element += ['destination_id'=> $dst_id];
                array_push($del_arg,'destination');
            }

            if ($sp_type == 'invoices'){
                array_push($del_arg,'apteka');
            }
            if ($sp_type == 'people'){array_push($del_arg,'apteka');}

            $errors .= $check->error;
        }
    //}

    if ($sp_type == 'podr'){
        array_push($element, 'name');
        $element['name'] = $element['apteka'];
        array_push($del_arg,'apteka');
    }

    if($sp_type == 'invoices'){$element['invoice_status_id'] = 1;}

    $element += ['id' => $id];

    foreach ($element as $key=>$value){
        if (!in_array($key, $del_arg)){
            $args[$key] = $value;
        }
    }
    $element1 = $args;

    if (empty($errors)){

        if ($id == 0) {$method = 'new';}else{$method = 'update';}

        if (isset($_POST['copy'])){
            $element['id'] = 0;
            $method = 'new';
        }

        //var_dump_($element1);

        $save = new SetData($sp_type, $element1, $method);

        if ($method == 'new') {$id = $save->result;}

        header("location: ./elem.php?id=$id&sp_type=$sp_type");
    }
}

if (isset($_POST['close'])) {
    if (isset($_COOKIE['text_search']) && (isset($_COOKIE['field_search']))){
        $str_search = './spr.php?search='. $_COOKIE['text_search'] . '&field_search=' . $_COOKIE['field_search'] . '&submit_search=search';
    }else{
        if ($sp_type == 'marketing') {
            $str_search = './spr.php?submit_search';
        }else {
            $str_search = './spr.php';
        }
    }
    header("location: $str_search");
}

require_once "./elem.html";