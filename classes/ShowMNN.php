<?php

/* Поиск всех записей в таблице MNN*/

class ShowMNN
{
    public $result_data;

    public function __construct($text_search)
    {
        $this->search($text_search);
    }

    public function search($text_search)
    {
        if (strlen($text_search) > 0){
            $sql = "SELECT * FROM MNN WHERE mnn_id = :str";
            $arg = ["str" => $text_search];
        }else {
            $sql = "SELECT * FROM MNN ORDER BY mnn_name";
            $arg = [];
        }

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}