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
            $sql = "SELECT id, morion_id, name, producer, barcode, tnved, nac, tax, marketing_id, gran_price,
                          sum_com,  form_prod, doza, name_torg, amount_in_a_package, internet_price,
                          internet_sales, fix_price, covid, MNN.MNN_name, sickness.sickness_name, covid_protokol, bonus,
                          marketing.m_name as m_name, project_dl, insulin
                      FROM names 
                      LEFT JOIN marketing ON marketing_id = m_id
                      LEFT JOIN MNN ON names.MNN_id = MNN.MNN_id
                      LEFT JOIN sickness ON MNN.sickness_id = sickness.sickness_id";
        }elseif ($fields == 'updates') {
            $sql = "SELECT * FROM names 
                      LEFT JOIN marketing ON marketing_id = m_id
                      LEFT JOIN MNN ON names.MNN_id = MNN.MNN_id
                     WHERE modify = 1";
        }elseif ($fields == 'marketings') {
            $sql = "SELECT m_id, m_name FROM marketing ORDER BY m_name";
        }elseif ($fields == 'mnn') {
            $sql = "SELECT MNN_id, MNN_name FROM MNN ORDER BY MNN_name";
        }elseif ($fields == 'form_prod') {
            $sql = "SELECT id, name FROM names_form_prod ORDER BY name";
        }else{
            $sql = "SELECT id, name, producer, m_name, MNN_name, tax, covid_protokol FROM names
                      LEFT JOIN marketing ON marketing_id = m_id
                      LEFT JOIN MNN ON names.MNN_id = MNN.MNN_id";
            $sql1 = "SELECT id, name, producer, m_name, MNN_name, tax, covid_protokol FROM names";
        }

        if ($field_search == 'Наименование') {
            $sql .= " WHERE name LIKE CONCAT('%', :str, '%') ORDER BY name";
        }elseif ($field_search == 'Производитель') {
            $sql .= " WHERE producer LIKE CONCAT('%', :str, '%') ORDER BY name";
        }elseif ($field_search == 'Код товара') {
            $sql .= " WHERE id LIKE :str";
        }elseif ($field_search == 'Код мориона') {
            $sql .= " WHERE morion_id LIKE :str";
        }elseif ($field_search == 'Маркетинг') {
            $sql = $sql1 . " LEFT JOIN marketing ON marketing_id = m_id
                             LEFT JOIN MNN ON names.MNN_id = MNN.MNN_id
                             WHERE m_name LIKE CONCAT('%', :str, '%') ORDER BY name";
        }elseif ($field_search == 'МНН') {
            $sql = $sql1 . " LEFT JOIN MNN ON names.MNN_id = MNN.MNN_id
                             LEFT JOIN marketing ON marketing_id=m_id 
                             WHERE MNN_name LIKE CONCAT('%', :str, '%') ORDER BY name";
        }elseif ($field_search == "Доступні Ліки"){
            $sql .= " WHERE project_dl = 1 ORDER BY name";
        }elseif ($field_search == 'Инсулин'){
            $sql .= " WHERE insulin = 1 ORDER BY name";
        }
        //$sql = $sql . "ORDER BY name";

        $arg = ["str" => $text_search];

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}