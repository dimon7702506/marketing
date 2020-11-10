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

        $fields_query_list = '';
        $table_name = '';
        $join = '';
        $order_by = '';
        
        if ($sp_type == 'podr') {
            $table_name = 'apteka';
            $fields_query_list = 'apteka.id, apteka.name as name, firm.name as firm_name';
            $fields_query_elem = 'apteka.name as name, firm.name as firm_name, apteka.adres as adres,
                apteka.tel as tel, email, people.full_name as zav_name, db_server, db_name, db_user, db_password,
                SQL_version, TM_version, google_login, google_password, saldo_path, tabletki_id, last_update,
                apteka.id as id, liki24_id';
            $join_table1 = ' firm';
            $join1 = " LEFT JOIN $join_table1 ON firm_id = firm.id";
            $join_table2 = ' people';
            $join2 = " LEFT JOIN $join_table2 ON zav_id = people.id";
            $join = $join1 . $join2;
            $fields_query_id = 'apteka.id';
            $order_by = 'firm.name, apteka.name';

            if ($field_search == 'Наименование') {
                $field_search = 'apteka.name';
            } elseif ($field_search == 'Фирма') {
                $field_search = 'firm.name';
            } elseif ($field_search == 'ID') {
                $field_search = 'apteka.id';
                $order_by = '';
            }
        }elseif ($sp_type == 'people'){
            $table_name = 'people';
            $fields_query_list = 'people.id, full_name as name, people.tel';
            $fields_query_elem = 'people.id, full_name, people.tel, birthday, tm_id, apteka.name as apteka';
            $fields_query_id = 'id';
            $join_table = ' apteka';
            $join = " LEFT JOIN $join_table ON apteka_id = apteka.id";
            $order_by = 'full_name';
            if ($field_search == 'ФИО'){
                $field_search = 'full_name';
            }elseif ($field_search == 'Телефон'){
                $field_search = 'tel';
            }elseif ($field_search == 'ID'){
                $field_search = 'people.id';
                $order_by = '';
            }
        }elseif ($sp_type == 'marketing'){
            $table_name = 'marketing';
            $fields_query_list = 'm_id, m_name as name, persent, summ, top, actual';
            $fields_query_elem = '*';
            $fields_query_id = 'm_id';
            $join_table = '';
            $join = "";
            $order_by = 'm_name';
            if ($field_search == 'Маркетинг'){
                $field_search = 'm_name';
            }elseif ($field_search == 'ID'){
                $field_search = $fields_query_id;
                $order_by = '';
            }
        }elseif ($sp_type == 'firm'){
            $table_name = 'firm';
            $fields_query_list = 'firm.name';
            $fields_query_elem = '*';
            $fields_query_id = 'id';
            $join_table = '';
            $join = "";
            $order_by = 'name';
        }elseif ($sp_type == 'providers') {
            $table_name = 'providers';
            $fields_query_list = 'providers.id, providers.name';
            $fields_query_elem = '*';
            $fields_query_id = 'id';
            $join_table = '';
            $join = "";
            $order_by = 'name';
            if ($field_search == 'Поставщик'){
                $field_search = 'name';
            }
        }

        if ($query_type == 'list'){
            $fields_query = $fields_query_list;
        }elseif ($query_type == 'elem'){
            $fields_query = $fields_query_elem;
        }elseif ($query_type == 'id'){
            $fields_query = $fields_query_id;
        }

        //var_dump($field_search);
        //var_dump($fields_query);

        $sql = "SELECT $fields_query FROM $table_name $join ";
        if (strlen($field_search) > 0){
            if (strpos($field_search, 'id') !== false){
                $sql .= "WHERE $field_search = :str";
            }else {
                $sql .= "WHERE $table_name.$field_search LIKE CONCAT('%', :str, '%')";
                $sql = str_replace('apteka.apteka', 'apteka', $sql);
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