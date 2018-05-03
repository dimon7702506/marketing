<?php

/* Поиск всех записей в таблице orders_type */

class ShowOrdersType
{
    public $result_data;

    public function __construct()
    {
        $this->search();
    }

    public function search()
    {
        $sql = "SELECT * FROM orders_type ORDER BY name";
        $arg = [];

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}