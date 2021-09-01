<?php

class SearchFromNamesRemainderList
{
    public $result_data;

    public function __construct($text_search)
    {
        $this->search($text_search);
    }

    public function search($text_search)
    {
        $sql = "SELECT names.id as id, name, producer, SUM(remainder.quantity) as quantity
                FROM names
                LEFT JOIN remainder ON name_id = names.id
                WHERE name LIKE CONCAT('%', :str, '%') 
                and quantity > 0
                GROUP BY id
                ORDER BY name";

        $arg = ["str" => $text_search];

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}