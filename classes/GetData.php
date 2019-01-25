<?php

/* Поиск записей в DB*/

class GetData
{
    public $result_data;

    public function __construct($sp_type, $text_search, $field_search, $query_type)
    {
        $this->search($sp_type, $text_search, $field_search, $query_type);
    }

    public function search($sp_type, $text_search, $field_search, $query_type)
    {
        //var_dump($sp_type);
        if ($sp_type == 'podr'){
            $table_name = 'apteka';
            $fields_query_list = 'apteka.id, apteka.name as apteka_name, firm.name as firm_name';
            $fields_query_elem = 'apteka.id, apteka.name as apteka_name, firm.name as firm_name';
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
        }elseif ($sp_type == 'people'){
            $table_name = 'people';
            $fields_query_list = 'id, full_name, tel';
            $fields_query_elem = '*';
            $join_table = '';
            $join = "";
            $order_by = 'full_name';
            if ($field_search == 'ФИО'){
                $field_search = 'full_name';
            }elseif ($field_search == 'Телефон'){
                $field_search = 'tel';
            }elseif ($field_search == 'ID'){
                $field_search = 'id';
                $order_by = '';
            }
        }

        if ($query_type == 'list'){
            $fields_query = $fields_query_list;
        }elseif ($query_type == 'elem'){
            $fields_query = $fields_query_elem;
        }

        $sql = "SELECT $fields_query FROM $table_name $join ";
        if (strlen($field_search) > 0){
            if ($field_search == 'id'){
                $sql .= "WHERE $field_search = :str";
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