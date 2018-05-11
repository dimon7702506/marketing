<?php

/* Поиск максимального номера ордера в таблице orders*/

class SearchMaxOrdersNumber
{
    public $result_data;

    public function __construct($apteka_id, $order_type)
    {
        $this->search($apteka_id, $order_type);
    }

    public function search($apteka_id, $order_type)
    {

        $sql = "SELECT max(num) as mn FROM orders 
                  LEFT JOIN orders_type ON type_id = orders_type.id 
                  WHERE apteka_id = :apteka_id AND orders_type.type = 
                    (SELECT orders_type.type FROM orders_type WHERE name = :order_type)";
        $arg = ["apteka_id" => $apteka_id,
                "order_type" => $order_type];

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}