<?php

/* Поиск всех записей в таблице MNN*/

class ShowMNN
{
    public $result_data;

    public function __construct($text_search, $field_search, $fields)
    {
        $this->search($text_search, $field_search, $fields);
    }

    public function search($text_search, $field_search, $fields)
    {
        if (strlen($field_search) > 0){
            $sql = "SELECT MNN_id, MNN_name, sickness_name FROM MNN LEFT JOIN sickness ON MNN.sickness_id = sickness.sickness_id";
            if ($field_search == 'МНН') {
                $sql .= " WHERE MNN_name LIKE CONCAT('%', :str, '%') ORDER BY MNN_name";
            }elseif ($field_search == 'ID'){
                $sql .= " WHERE MNN_id = :str";
            }
            $arg = ["str" => $text_search];
        }else {
            if (strlen($text_search) > 0) {
                $sql = "SELECT * FROM MNN WHERE mnn_id = :str";
                $arg = ["str" => $text_search];
            } else {
                $sql = "SELECT * FROM MNN ORDER BY mnn_name";
                $arg = [];
            }
        }


        $arg = ["str" => $text_search];
        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}