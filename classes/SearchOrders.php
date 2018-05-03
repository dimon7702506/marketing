<?php

/* Поиск записей в таблице orders*/

class SearchOrders
{
    public $result_data;

    public function __construct($start_date, $end_date)
    {
        $this->search($start_date, $end_date);
    }

    public function search($start_date, $end_date)
    {
        //SELECT orders_type.name, type_id FROM orders LEFT JOIN orders_type ON type_id = orders_type.id
        $sql = "SELECT orders.id as id, orders_type.name as order_type, date, num, sum FROM orders
                  LEFT JOIN orders_type ON type_id = orders_type.id";

        $arg = ["str" => $start_date];

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}