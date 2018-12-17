<?php
/* Сохранение изменений в таблицу MNN*/

class SaveToDBMNN
{
    public $result;

    function __construct($element, $method)
    {
        $this->save($element, $method);
    }

    function save($element, $method)
    {
        $sql_sickness = "SELECT sickness_id FROM sickness WHERE sickness_name = :sickness";
        if ($method == 'update') {
            $sql_update = "UPDATE MNN SET MNN_name = :mnn, sickness_id = ($sql_sickness)";
            $sql_end = " WHERE MNN_id = :id";
            $sql = $sql_update . $sql_end;
            $args = $element;
        }elseif ($method == 'new') {
            $sql_update = "INSERT INTO MNN (MNN_name,   sickness_id)
                                      VALUES (:mnn, ($sql_sickness))";
            $sql = $sql_update;

            $del_arg=['id'];
            foreach ($element as $key=>$value){
                if (!in_array($key, $del_arg)){
                    $args[$key] = $value;
                }
            }
        }

        $stmt = DB::run($sql, $args);
        $sql_id = "SELECT LAST_INSERT_ID();";
        $stmt1 = DB::run($sql_id, $args);
        $data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $d = $data[0];
        $this->result = (int) $d['LAST_INSERT_ID()'];
    }
}