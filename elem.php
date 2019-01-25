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

    }elseif ($sp_type == 'people') {
        $fields = ['full_name' => ['field_name' => 'ФИО',
                                    'type' => 'text',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 100,
                                    'str_num' => 1,
                                    'col' => 6,
                                    'required' => 'required'],
                    'tel' => ['field_name' => 'Телефон',
                                'type' => 'number',
                                'min' => 0,
                                'max' => 999999999,
                                'length' => 10,
                                'str_num' => 1,
                                'col' => 2,
                                'required' => ''],
                    'birthday' => ['field_name' => 'Дата рождения',
                                    'type' => 'date',
                                    'min' => 0,
                                    'max' => 0,
                                    'length' => 0,
                                    'str_num' => 1,
                                    'col' => 2,
                                    'required' => 'required'],
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
            $name = trim($result['apteka_name']);
            $firma = trim($result['firm_name']);
            $html_elem = "<div class=\"form-group col-md-6\">
                            <label for=\"inputEmail4\">Наименование</label>
                            <input type=\"text\" class=\"form-control\" id=\"inputEmail4\" value=\"$name\"
                                name=\"$name\" required>
                          </div>";
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
            //var_dump($results);
        }

        //var_dump($fields);
        foreach ($fields as $key => $f) {
            //var_dump($key);
            $html_elem .= '<div class="form-group col-md-' . $f['col'] . '">
                                <label for="inputEmail4">' . $f['field_name'] . '</label>
                                <input type="' . $f['type'] . '" class="form-control" id="inputEmail1" value="'.$result[$key].'"
                                name="'.$key.'" ' . $f['required'].'>
                            </div>';
            var_dump($html_elem);
        }
    }
}

if (isset($_POST['save']) || isset($_POST['copy'])) {

    $element = [];

    if ($sp_type == 'podr') {

    } elseif ($sp_type == 'people'){
        //var_dump($fields);
        foreach ($fields as $key => $f) {
            //var_dump($f);
            $check = new CheckFields($f['field_name'], $f['type'], $f['min'], $f['max'], $f['length'], $_POST[$key]);
            $val = $check->value;
            if ($f['type'] == 'number'){
                $val = (int) $val;
            }elseif ($f['type'] == 'text'){
                $val = trim($val);
            }
            $element += [$key=>$val];
            $errors .= $check->error;
        }
    }
    $element += ['id' => $id];
    //var_dump($element);

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

        $save = new SetData($sp_type, $element, $method);

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