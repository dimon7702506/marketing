<?php

/* Поиск сотрудника по id в таблице people*/

class GetPeopleById
{
    public $result_data;

    public function __construct($id)
    {
        $this->search($id);
    }

    public function search($id)
    {
        $sql = "SELECT * FROM people WHERE id = :id";

        $arg = ["id" => $id];

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result_data = $data;
    }
}