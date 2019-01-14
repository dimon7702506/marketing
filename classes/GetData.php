<?php

/* Поиск записей в DB*/

class GetData
{
    public $result_data;

    public function __construct($sp_type, $text_search, $field_search, $fields)
    {
        $this->search($sp_type, $text_search, $field_search, $fields);
    }

    public function search($sp_type, $text_search, $field_search, $fields)
    {
        //var_dump($sp_type);
        if ($sp_type == 'podr'){
            $table_name = 'apteka';
            $fields_query = 'id, name, firm_id';
            $order_by = 'firm_id, name';

        }

        $sql = "SELECT $fields_query FROM $table_name ORDER BY $order_by";

/*        if (strlen($field_search) > 0){
            $sql = "SELECT MNN_id, MNN_name, sickness_name FROM MNN LEFT JOIN sickness ON MNN.sickness_id = sickness.sickness_id";
            if ($field_search == 'МНН') {
                $sql .= " WHERE MNN_name LIKE CONCAT('%', :str, '%') ORDER BY MNN_name";
            }elseif ($field_search == 'ID'){
                $sql .= " WHERE MNN_id = :str";
            }elseif ($field_search == 'Заболевание') {
                $sql .= " WHERE sickness_name LIKE CONCAT('%', :str, '%') ORDER BY MNN_name";
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
        }*/

        //var_dump($sql);
        $arg = ["str" => $text_search];
        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}