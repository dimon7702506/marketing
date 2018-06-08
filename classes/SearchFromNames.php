<?php

/* Поиск записей в таблице names*/

class SearchFromNames
{
    public $result_data;

    public function __construct($text_search, $field_search, $fields)
    {
        $this->search($text_search, $field_search, $fields);
    }

    public function search($text_search, $field_search, $fields)
    {
        if ($fields == 'all') {
            $sql = "SELECT * FROM names 
                      LEFT JOIN marketing ON marketing_id = m_id
                      LEFT JOIN MNN ON names.MNN_id = MNN.MNN_id";
        }elseif ($fields == 'updates') {
            $sql = "SELECT * FROM names 
                      LEFT JOIN marketing ON marketing_id = m_id
                      LEFT JOIN MNN ON names.MNN_id = MNN.MNN_id
                     WHERE modify = 1";
        }elseif ($fields == 'marketings') {
            $sql = "SELECT m_id, m_name FROM marketing ORDER BY m_name";
        }elseif ($fields == 'mnn') {
            $sql = "SELECT MNN_id, MNN_name FROM MNN ORDER BY MNN_name";
        }else{
            $sql = "SELECT id, name, producer, m_name, MNN_name FROM names
                      LEFT JOIN marketing ON marketing_id = m_id
                      LEFT JOIN MNN ON names.MNN_id = MNN.MNN_id";
            $sql1 = "SELECT id, name, producer, m_name, MNN_name FROM names";
        }

        if ($field_search == 'Наименование') {
            $sql .= " WHERE name LIKE CONCAT('%', :str, '%') ORDER BY name";
        }elseif ($field_search == 'Производитель') {
            $sql .= " WHERE producer LIKE CONCAT('%', :str, '%')";
        }elseif ($field_search == 'Код товара') {
            $sql .= " WHERE id LIKE :str";
        }elseif ($field_search == 'Код мориона') {
            $sql .= " WHERE morion_id LIKE :str";
        }elseif ($field_search == 'Маркетинг') {
            $sql = $sql1 . " LEFT JOIN marketing ON marketing_id = m_id
                             LEFT JOIN MNN ON names.MNN_id = MNN.MNN_id
                             WHERE m_name LIKE CONCAT('%', :str, '%')";
        }elseif ($field_search == 'МНН') {
            $sql = $sql1 . " LEFT JOIN MNN ON names.MNN_id = MNN.MNN_id
                             LEFT JOIN marketing ON marketing_id=m_id 
                             WHERE MNN_name LIKE CONCAT('%', :str, '%')";
        }

        $arg = ["str" => $text_search];

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}