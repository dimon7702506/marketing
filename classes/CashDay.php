<?php
/**
 * Created by PhpStorm.
 * User: dimon
 * Date: 27.09.2022
 * Time: 11:48
 */

class CashDay

{
    public $result_data;

    public function getSaldo($apteka_id, $date)
    {

        $sql = "SELECT apteka_id, date_cash, cash_end_k1, cash_end_k2, cash_end_k3 FROM cash_day 
                  WHERE apteka_id = :apteka_id AND date_cash < :date ORDER BY id DESC LIMIT 1";

        $arg = ["apteka_id" => $apteka_id,
                "date" => $date];

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
        return $data;
    }
/*
    public function setSaldo($apteka_id, $date, $sum, $method, $id)
    {
        if ($method == 'new') {
            $sql = "INSERT INTO cash_saldo (apteka_id, date, saldo) VALUES (:apteka_id, :date, :sum)";
            $arg = ["apteka_id" => $apteka_id,
                "date" => $date,
                "sum" => $sum];
            $stmt = DB::run($sql, $arg);
        }else{
            $sql = "UPDATE cash_saldo SET saldo = :sum WHERE id = :id";
            $arg = ["sum" => $sum,
                "id" => $id];
            $stmt = DB::run($sql, $arg);
        }
    }

    public function chekSetSaldo($apteka_id)
    {
        $sql = "SELECT count(*) as count FROM cash_saldo WHERE apteka_id = :apteka_id";
        $arg = ["apteka_id" => $apteka_id];
        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
        return $data;
    }
*/
}