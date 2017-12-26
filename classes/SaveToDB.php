<?php
/* Сохранение изменений в БД */

class SaveToDB
{
    public $result;

    function __construct($element, $method)
    {
        $this->save($element, $method);
    }

    function save($element, $method)
    {
        if ($method='update'){
            $sql_m = "SELECT m_id FROM marketing WHERE m_name = :marketing";
            $sql_mnn = "SELECT MNN_id FROM MNN WHERE MNN_name = :str_mnn";
            $sql_update = "UPDATE names SET name = :name, morion_id = :morion_id, producer = :producer, barcode = :barcode, 
                    tnved = :tnved, nac = :nac, tax = :tax, sum_com = :sum_com, form_prod =:form_prod, name_torg = :name_torg,
                    gran_price =:gran_price";
            $sql_end = " WHERE id = :id";
            $sql = $sql_update . $sql_end;
        }

        $stmt = DB::run($sql, $element);
        $data = $stmt->rowCount();
        $this->result = $data;
        var_dump($data);

    }
}