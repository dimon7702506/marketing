<?php

/* Поиск всех записей в таблице marketings*/

class ShowMarketings
{
    public $result_data;

    public function __construct($text_search, $field_search)
    {
        $this->search($text_search, $field_search);
    }

    public function search($text_search, $field_search)
    {
        if (strlen($text_search) > 0){
            $sql = "SELECT * FROM marketing WHERE m_id = :str";
            $arg = ["str" => $text_search];
        }else {
            $sql = "SELECT * FROM marketing ORDER BY m_name";
            $arg = [];
        }

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}