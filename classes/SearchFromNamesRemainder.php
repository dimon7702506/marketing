<?php

class SearchFromNamesRemainder
{
    public $result_data;

    public function __construct($id_search) {$this->search($id_search);}

    public function search($id_search)
    {
        $sql = "SELECT apteka.name as apteka, apteka.adres as adres, apteka.tel as tel, price, quantity, relevance,
                  names.name as name, price_zak, date_pr, date_sr 
                FROM remainder
                LEFT JOIN apteka ON apteka_id = apteka.id
                LEFT JOIN names ON name_id = names.id
                WHERE name_id = :str
                ORDER BY apteka";

        //$sql = $sql . "ORDER BY name";

        $arg = ["str" => $id_search];

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}