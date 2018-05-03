<?php
/* Сохранение изменений в таблицу orders*/

class SaveToDBOrders
{
    public $result;

    function __construct($element, $method)
    {
        $this->save($element, $method);
    }

    function save($element, $method)
    {
        $sql_orders_type = "SELECT id FROM orders_type WHERE name = :order_type";
        if ($method == 'update') {
            $sql_update = "UPDATE names SET name = :name, morion_id = :morion_id, producer = :producer, barcode = :barcode, 
                    tnved = :tnved, nac = :nac, tax = :tax, sum_com = :sum_com, form_prod =:form_prod, doza = :doza, name_torg = :name_torg,
                    gran_price =:gran_price, marketing_id = ($sql_m), MNN_id = ($sql_mnn), modify = 1";
            $sql_end = " WHERE id = :id";
            $sql = $sql_update . $sql_end;
            $args = $element;
        }elseif ($method == 'update_modify') {
            $sql = "UPDATE names SET modify = 0";
            $args = [];
        }elseif ($method == 'new') {
            $sql_update = "INSERT INTO orders (type_id,  apteka_id,  num,  sum,  date)
                            VALUES (($sql_orders_type), :apteka_id, :num, :sum, :date)";
            $sql = $sql_update;

            $del_arg=['id'];
            foreach ($element as $key=>$value){
                if (!in_array($key, $del_arg)){
                    $args[$key] = $value;
                }
            }
        }

        $stmt = DB::run($sql, $args);
        $sql_id = "SELECT LAST_INSERT_ID();";
        $stmt1 = DB::run($sql_id, $args);
        $data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $d = $data[0];
        $this->result = (int) $d['LAST_INSERT_ID()'];
    }
}