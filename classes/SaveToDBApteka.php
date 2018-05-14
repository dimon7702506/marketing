<?php
/* Сохранение изменений в БД в таблице apteka*/

class SaveToDBApteka
{
    public $result;

    function __construct($element, $method)
    {
        $this->save($element, $method);
    }

    function save($element, $method)
    {
        if ($method == 'update_last_cash_report_nuber') {
            $sql = "UPDATE apteka SET last_cash_report_number = :num WHERE id = :id";
            $args = $element;
     /*   }elseif ($method == 'new') {
            $sql_update = "INSERT INTO marketing (m_name,   persent,  summ) VALUES (:name, :persent, :summ)";
            $sql = $sql_update;

            $del_arg=['id'];
            foreach ($element as $key=>$value){
                if (!in_array($key, $del_arg)){
                    $args[$key] = $value;
                }
            }*/
        }

        $sql_id = "SELECT LAST_INSERT_ID();";
        $stmt = DB::run($sql, $args);
        $stmt1 = DB::run($sql_id, $args);
        $data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $d = $data[0];
        $this->result = (int) $d['LAST_INSERT_ID()'];
    }
}