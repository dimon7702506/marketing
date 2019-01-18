<?php

/* Поиск записей в DB*/

class GetData
{
    public $result_data;

    public function __construct($sp_type, $text_search, $field_search)
    {
        $this->search($sp_type, $text_search, $field_search);
    }

    public function search($sp_type, $text_search, $field_search)
    {
        //var_dump($sp_type);
        if ($sp_type == 'podr'){
            $table_name = 'apteka';
            $fields_query = 'apteka.id, apteka.name as apteka_name, firm.name as firm_name';
            $join_table = ' firm';
            $join = " LEFT JOIN $join_table ON firm_id = firm.id";
            $order_by = 'firm.name, apteka.name';
            if ($field_search == 'Наименование'){
                $field_search = 'apteka.name';
            }elseif ($field_search == 'Фирма'){
                $field_search = 'firm.name';
            }elseif ($field_search == 'ID'){
                $field_search = 'apteka.id';
                $order_by = '';
            }
        }

        $sql = "SELECT $fields_query FROM $table_name $join ";
        if (strlen($field_search) > 0){
            if ($field_search == 'ID'){
                $sql .= "WHERE $field_search = :str)";
            }else {
                $sql .= "WHERE $field_search LIKE CONCAT('%', :str, '%')";
            }
            $arg = ["str" => $text_search];
        }else{
            $arg = [];
        }
        $arg = ["str" => $text_search];
        if (strlen($order_by) > 0){
            $sql .= "ORDER BY $order_by";
        }
        //var_dump($sql);
        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}