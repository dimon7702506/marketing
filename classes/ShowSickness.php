<?php

/* Поиск всех записей в таблице sickness*/

class ShowSickness
{
    public $result_data;

    public function __construct($text_search)
    {
        $this->search($text_search);
    }

    public function search($text_search)
    {
        if (strlen($text_search) > 0){
            $sql = "SELECT * FROM sickness WHERE sickness_id = :str";
            $arg = ["str" => $text_search];
        }else {
            $sql = "SELECT * FROM sickness ORDER BY sickness_name";
            $arg = [];
        }

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}