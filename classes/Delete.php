<?php


class Delete
{
    public $result_data;

    public function __construct($element)
    {
        $this->del($element);
    }

    public function del($element)
    {
        $sql_delete = "DELETE FROM tek_saldo";

            $i = 0;
            $sql_element = " WHERE apteka_id IN (";
            foreach ($element as $key) {
                $i++;
                $sql_element .= " $key";
                if ($i < count($element)) {
                    $sql_element .= ",";
                }
            }
        $sql_element .= " )";

        $sql = $sql_delete . $sql_element;

        var_dump($sql);
        //var_dump($args);

        $stmt = DB::run($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


    }
}