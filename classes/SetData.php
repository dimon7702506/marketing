<?php

/* Сохранение записей в DB*/

class SetData
{
    public $result_data;

    public function __construct($sp_type, $element, $method)
    {
        $this->save($sp_type, $element, $method);
    }

    public function save($sp_type, $element, $method)
    {
        if ($sp_type == 'podr'){
            $table_name = 'apteka';
            $id_name = 'id';
        }elseif ($sp_type == 'people'){
            $table_name = 'people';
            $id_name = 'id';
        }elseif ($sp_type == 'cash_saldo'){
            $table_name = 'cash_saldo';
            $id_name = 'id';
        }elseif ($sp_type == 'saldo'){
            $table_name = 'tek_saldo';
            $id_name = 'id';
        }elseif ($sp_type == 'marketing') {
            $table_name = 'marketing';
            $id_name = 'm_id';
        }elseif ($sp_type == 'providers') {
            $table_name = 'providers';
            $id_name = 'id';
        }elseif ($sp_type == 'invoices') {
            $table_name = 'invoice';
            $id_name = 'id';
        }elseif ($sp_type == 'invoice_status') {
            $table_name = 'invoice_status';
            $id_name = 'id';
        }elseif ($sp_type == 'users'){
            $table_name = 'users';
            $id_name = 'id';
            $element['password_hash'] = md5(md5(trim($_POST['password'])));
            $element['password'] = '';
        }elseif ($sp_type == 'routes') {
            $table_name = 'routes';
            $id_name = 'id';
        }elseif ($sp_type == 'destination') {
            $table_name = 'destination';
            $id_name = 'id';
        }elseif ($sp_type == 'routes_standart') {
            $table_name = 'routes_standart';
            $id_name = 'id';
        }elseif ($sp_type == 'remainder'){
            $table_name = 'remainder';
            $id_name = 'id';
        }elseif ($sp_type == 'news'){
            $table_name = 'news';
            $id_name = 'id';
        }elseif ($sp_type == 'cash_day'){
            $table_name = 'cash_day';
            $id_name = 'id';
        }elseif ($sp_type == 'bill'){
            $table_name = 'bill';
            $id_name = 'id';
        }
        //var_dump($element);
        $sql_update = '';
        $sql_end = '';

        if ($method == 'update') {
            $sql_update = "UPDATE $table_name SET";

            $i = 0;
            foreach ($element as $key => $el){
                if ($key != 'id') {
                    $i++;
                    $sql_update .= " $key = :$key";
                }
                if ($i < count($element) - 1){$sql_update .= ",";}
            }
            $sql_end = " WHERE $id_name = :id";
            $args = $element;
        }elseif ($method == 'new') {
            $sql_update = "INSERT INTO $table_name (";

            $i = 0;
            foreach ($element as $key => $el){
                if ($key != 'id') {
                    $i++;
                    $sql_update .= " $key";
                }
                if ($i < count($element) -1){
                    $sql_update .= ",";
                }
            }
            $sql_update .= ") VALUES (";
            $i = 0;
            foreach ($element as $key => $el){
                if ($key != 'id') {
                    $i++;
                    $sql_update .= " :$key";
                }
                if ($i < count($element) - 1){$sql_update .= ",";}
            }
            $sql_update .= ")";
            $del_arg=['id'];
            foreach ($element as $key=>$value){
                if (!in_array($key, $del_arg)){$args[$key] = $value;}
            }
        }

        $sql = $sql_update . $sql_end;

        $sql = str_replace('SET,', 'SET', $sql);
        $sql = str_replace('(,', '(', $sql);

        //var_dump($sql);
        //var_dump($args);

        $sql_id = "SELECT LAST_INSERT_ID();";
        $stmt = DB::run($sql, $args);
        $stmt1 = DB::run($sql_id, $args);
        $data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $d = $data[0];
        $this->result = (int) $d['LAST_INSERT_ID()'];
    }
}