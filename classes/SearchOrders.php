<?php

/* Поиск записей в таблице orders*/

class SearchOrders
{
    public $result_data;

    public function __construct($start_date, $end_date, $apteka_id)
    {
        $this->search($start_date, $end_date, $apteka_id);
    }

    public function search($start_date, $end_date, $apteka_id)
    {
        $sql = "SELECT orders.id as id, orders_type.name as order_type, date, num, sum, last_cash_report_number
                  FROM orders
                  LEFT JOIN orders_type ON type_id = orders_type.id 
                  WHERE apteka_id = :apteka_id 
                    and date >= :start_date 
                    and date <= :end_date 
                  ORDER BY date, num ASC";

        $arg = ["apteka_id" => $apteka_id,
                "start_date" => $start_date,
                "end_date" => $end_date];

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}