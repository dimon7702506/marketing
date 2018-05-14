<?php

class Requisites
{
    public $result_data;

    public function __construct($apteka_id)
    {
        $this->search($apteka_id);
    }

    public function search($apteka_id)
    {
        $sql = "SELECT okpo, firm.name as firma, last_cash_report_number,apteka.name as apteka, people.fio as zav, zav_id
                FROM apteka
                LEFT JOIN firm ON firm.id = firm_id
                LEFT JOIN people ON people.id = zav_id
                WHERE apteka.id = :apteka";

        $arg = ["apteka" => $apteka_id];

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}