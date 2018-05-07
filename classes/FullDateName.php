<?php

class FullDateName
{
    public $result_data;

    public function __construct($date)
    {
        $this->search($date);
    }

    public function search($date)
    {
        $d = date("d", strtotime($date));
        $m = date("n", strtotime($date));
        $y = date("Y", strtotime($date));

        $sql = "SELECT * FROM month WHERE id = :num";

        $arg = ["num" => $m];

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->result_data = $d . ' ' . $data[0]['name_ukr_ot'] . ' ' . $y;
    }
}