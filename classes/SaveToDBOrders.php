<?php
/* Сохранение изменений в БД в таблице marketing*/

class SaveToDBMarketings
{
    public $result;

    function __construct($element, $method)
    {
        $this->save($element, $method);
    }

    function save($element, $method)
    {
        if ($method == 'update') {
            $sql_update = "UPDATE marketing SET m_name = :name, persent = :persent, summ = :summ";
            $sql_end = " WHERE m_id = :id";
            $sql = $sql_update . $sql_end;
            $args = $element;
        }elseif ($method == 'new') {
            $sql_update = "INSERT INTO marketing (m_name,   persent,  summ) VALUES (:name, :persent, :summ)";
            $sql = $sql_update;

            $del_arg=['id'];
            foreach ($element as $key=>$value){
                if (!in_array($key, $del_arg)){
                    $args[$key] = $value;
                }
            }
        }

        $sql_id = "SELECT LAST_INSERT_ID();";
        $stmt = DB::run($sql, $args);
        $stmt1 = DB::run($sql_id, $args);
        $data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $d = $data[0];
        $this->result = (int) $d['LAST_INSERT_ID()'];
    }
}