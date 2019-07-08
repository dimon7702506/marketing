<?php

require_once "./function.php";
require_once "autoload.php";

$html_elem = '';
$errors = '';
$fio = '';
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

    if ($sp_type == 'podr') {
        $fields = ['name' => ['field_name' => 'Аптека',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 50,
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
                                    'length' => 50,
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
                    'last_update' => ['field_name' => 'Обновление',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 50,
                                    'str_num' => 3,
                                    'col' => 2,
                                    'required' => '',
                                    'related_table' => '',
                                    'form_type'=>'input'],

        ];

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
                    'birthday' => ['field_name' => 'Дата рождения',
                                    'type' => 'date',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 0,
                                    'str_num' => 1,
                                    'col' => 2,
                                    'required' => 'required',
                                    'related_table' => '',
                                    'form_type'=>'input'],
                    ];
    }

    if (empty($results)){
        $res = [];
        foreach ($fields as $key=>$val){
            $res += [$key => ''];

        }
        array_push($results, $res);
    }

    foreach ($results as $result){
        if ($sp_type == 'podr') {
            $apteka = trim($result['name']);
            $firm = $result['firm_name'];
            $zav = $result['zav_name'];
        }elseif ($sp_type == 'people'){
            $fio = trim($result['full_name']);
            $tel = $result['tel'];
            $birthday = $result['birthday'];
            if (!array_key_exists('dismissed', $result)) {
                $result += ['dismissed' => 0];
            }
            $dismissed = $result['dismissed'];

            if($dismissed == 1){
                $errors = 'Уволен!!!';
            }
        }
        //var_dump($results);

        foreach ($fields as $key => $f) {
            //var_dump($key);
            $html_elem .= '<div class="form-group col-md-' . $f['col'] . '">
                                <label for="inputEmail4">' . $f['field_name'] . '</label>';
            if ($f['form_type'] == 'input') {
                $html_elem .= '<input type="' . $f['type'] . '" class="form-control" id="inputEmail1" value="' . $result[$key] . '"
                                name="' . $key . '" ' . $f['required'] . '>';
            }elseif ($f['form_type'] == 'select'){
                $html_elem .= '<select id="inputState" class="form-control" name="' . $key . '">
                                <option selected>';
                if($key == 'firm_name') {
                    $html_elem .= $firm;
                    $sp_type_list = 'firm';
                }elseif ($key == 'zav_name'){
                    $html_elem .= $zav;
                    $sp_type_list = 'people';
                }
                $html_elem .= '</option>
                                <option></option>';

                $find_list = new GetData($sp_type_list,'','', 'list');
                $lists = $find_list->result_data;
                //var_dump($lists);
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

if (isset($_POST['save']) || isset($_POST['copy'])) {

    $element = [];
    $del_arg = [];

    //if ($sp_type == 'podr') {

    //} elseif ($sp_type == 'people'){
        //var_dump($fields);
        foreach ($fields as $key => $f) {
            //var_dump($f);
            $check = new CheckFields($f['field_name'], $f['type'], $f['min'], $f['max'], $f['length'],
                $_POST[$key], $f['required']);
            $val = $check->value;
            if ($f['type'] == 'number'){
                $val = (int) $val;
            }elseif ($f['type'] == 'text'){
                $val = trim($val);
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

            $errors .= $check->error;
        }
    //}
    $element += ['id' => $id];

    foreach ($element as $key=>$value){
        if (!in_array($key, $del_arg)){
            $args[$key] = $value;
        }
    }
    $element1 = $args;

    if (empty($errors)){

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

        $save = new SetData($sp_type, $element1, $method);

        if ($method == 'new') {
            $id = $save->result;
        }
        header("location: ./elem.php?id=$id&sp_type=$sp_type");
    }
}

if (isset($_POST['close'])) {
    //var_dump($_COOKIE['text_search']);
    if (isset($_COOKIE['text_search']) && (isset($_COOKIE['field_search']))){
        $str_search = './spr.php?search='. $_COOKIE['text_search'] . '&field_search=' . $_COOKIE['field_search'] . '&submit_search=search';
    }else{
        $str_search = './spr.php';
    }
    header("location: $str_search");
}

require_once "./elem.html";