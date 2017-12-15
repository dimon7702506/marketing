<?php

/* Поиск записей в таблице names*/

class Find
{
    public $result_data;

    public function __construct($text_search, $field_search, $fields)
    {
        $this->search($text_search, $field_search, $fields);
    }

    public function search($text_search, $field_search, $fields)
    {
        if ($fields == 'all') {
            $sql = "SELECT * FROM names";
        }else {
            $sql = "SELECT id, name, producer FROM names";
        }

        $arg = [];

        if ($field_search == 'Наименование') {
            $sql .= " WHERE name LIKE CONCAT('%', :str, '%')";
            $arg = ["str"=>$text_search];
        }elseif ($field_search == 'Производитель') {
            $sql .= " WHERE producer LIKE CONCAT('%', :str, '%')";
            $arg = ["str" => $text_search];
        }

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}