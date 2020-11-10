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
        //var_dump($sp_type);
        if ($sp_type == 'podr'){
            $table_name = 'apteka';
            $id_name = 'id';
        }elseif ($sp_type == 'people'){
            $table_name = 'people';
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
                if ($i < count($element) - 1){
                    $sql_update .= ",";
                }
            }
            $sql_end = " WHERE $id_name = :id";
            $args = $element;
        }elseif ($method == 'new') {
            $sql_update = "INSERT INTO $table_name (";
            //$sql_update = "INSERT INTO $table_name (m_name,   persent,  summ) VALUES (:name, :persent, :summ)";
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
                if ($i < count($element) - 1){
                    $sql_update .= ",";
                }
            }
            $sql_update .= ")";
            $del_arg=['id'];
            foreach ($element as $key=>$value){
                if (!in_array($key, $del_arg)){
                    $args[$key] = $value;
                }
            }
        }

        $sql = $sql_update . $sql_end;

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