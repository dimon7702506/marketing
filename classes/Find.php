<?php

/* Поиск записей в таблице names*/

class Find
{
    public $result_data;

    public function __construct($text_search, $field_search, $fields)
    {
        $this->search($text_search, $field_search, $fields);
    }

    public function search($text_search, $field_search, $fields)
    {
        if ($fields == 'all') {
            $sql = "SELECT * FROM names LEFT JOIN marketing ON marketing_id = m_id";
        }elseif ($fields == 'marketings') {
            $sql = "SELECT m_name FROM marketing";
        }else{
            $sql = "SELECT id, name, producer, m_name FROM names LEFT JOIN marketing ON marketing_id = m_id";
            $sql1 = "SELECT id, name, producer, m_name FROM names";
        }

        if ($field_search == 'Наименование') {
            $sql .= " WHERE name LIKE CONCAT('%', :str, '%')";
        }elseif ($field_search == 'Производитель') {
            $sql .= " WHERE producer LIKE CONCAT('%', :str, '%')";
        }elseif ($field_search == 'Код товара') {
            $sql .= " WHERE id LIKE :str";
        }elseif ($field_search == 'Код мориона') {
            $sql .= " WHERE morion_id LIKE :str)";
        }elseif ($field_search == 'Маркетинг') {
            $sql = $sql1 . " INNER JOIN marketing ON marketing_id=m_id WHERE m_name LIKE CONCAT('%', :str, '%')";
        }
        //ROM `names` INNER JOIN `marketing` ON names.marketing_id=marketing.id WHERE marketing.name LIKE '%Битт%'
        if (isset($fields)) {
            $arg = ["str" => $text_search];
        }else{
            $arg = [];
        }

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}