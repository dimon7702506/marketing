<?php

/* Поиск ордера по id в таблице orders*/

class SearchOrder
{
    public $result_data;

    public function __construct($id)
    {
        $this->search($id);
    }

    public function search($id)
    {
        $sql = "SELECT orders.id as id, orders_type.name as order_type, date, num, sum FROM orders
                  LEFT JOIN orders_type ON type_id = orders_type.id 
                  WHERE orders.id = :id";

        $arg = ["id" => $id];

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}