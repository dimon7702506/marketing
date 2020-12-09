<?php
/* Сохранение изменений в таблицу names*/

class SaveUkrNamesToDB
{
    public $result;

    function __construct($id, $name)
    {
        $this->save($id, $name);
    }

    function save($id, $name)
    {
        $sql_update = "UPDATE names SET name_ukr = :name_ukr";
        $sql_end = " WHERE morion_id = :id";
        $sql = $sql_update . $sql_end;
        $args = ['name_ukr'=>$name, 'id'=>$id];

        var_dump($name);

        $stmt = DB::run($sql, $args);
        $sql_id = "SELECT LAST_INSERT_ID();";
        $stmt1 = DB::run($sql_id, $args);
        $data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $d = $data[0];
        $this->result = (int) $d['LAST_INSERT_ID()'];
    }
}