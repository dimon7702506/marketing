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

/*        $element = ['id'=>$id,
            'date'=>$date_doc,
            'order_type'=>$order_type,
            'apteka_id'=>$apteka_id,
            'num'=>$num,
            'sum'=>(float) $sum];*/

        if ($method == 'update') {
            $sql = "UPDATE orders
                    SET type_id = ($sql_orders_type), apteka_id = :apteka_id, num = :num, sum = :sum, date = :date
                    WHERE  id = :id";
            $args = $element;
        }elseif ($method == 'new') {
            $sql = "INSERT INTO orders (type_id,  apteka_id,  num,  sum,  date)
                     VALUES (($sql_orders_type), :apteka_id, :num, :sum, :date)";

            $del_arg=['id'];
            foreach ($element as $key=>$value){
                if (!in_array($key, $del_arg)){
                    $args[$key] = $value;
                }
            }
        }

        var_dump(DB::run($sql, $args));
        $stmt = DB::run($sql, $args);
        $sql_id = "SELECT LAST_INSERT_ID();";
        $stmt1 = DB::run($sql_id, $args);
        $data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $d = $data[0];
        $this->result = (int) $d['LAST_INSERT_ID()'];
    }
}