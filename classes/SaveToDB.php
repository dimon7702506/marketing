<?php
/* Сохранение изменений в таблицу names*/

class SaveToDB
{
    public $result;

    function __construct($element, $method)
    {
        $this->save($element, $method);
    }

    function save($element, $method)
    {
        $sql_m = "SELECT m_id FROM marketing WHERE m_name = :marketing";
        $sql_mnn = "SELECT MNN_id FROM MNN WHERE MNN_name = :mnn";
        if ($method == 'update') {
            $sql_update = "UPDATE names SET name = :name, morion_id = :morion_id, producer = :producer, barcode = :barcode, 
                    tnved = :tnved, nac = :nac, tax = :tax, sum_com = :sum_com, sum_dop = :sum_dop, form_prod =:form_prod, doza = :doza, name_torg = :name_torg,
                    gran_price =:gran_price, marketing_id = ($sql_m), MNN_id = ($sql_mnn), modify = 1,
                    amount_in_a_package = :amount_in_a_package, project_dl = :project_dl, internet_price = :internet_price, internet_sales = :internet_sales,
                    fix_price = :fix_price, covid = :covid, covid_protokol = :covid_protokol, bonus = :bonus, last_modify_author_id = :last_modify_author_id,
                    insulin = :insulin, baby_box = :baby_box, antibiotics = :antibiotics";
            $sql_end = " WHERE id = :id";
            $sql = $sql_update . $sql_end;
            $args = $element;
        }elseif ($method == 'update_modify') {
            $sql = "UPDATE names SET modify = 0";
            $args = [];
        }elseif ($method == 'new') {
            $sql_update = "INSERT INTO names (name, morion_id, producer, barcode, tnved, nac, tax, sum_com, sum_dop, form_prod, doza, name_torg,
                              gran_price, marketing_id, MNN_id, modify, amount_in_a_package, project_dl, internet_price, internet_sales, fix_price, covid, covid_protokol, bonus,
                              last_modify_author_id, author_id, insulin, baby_box, antibiotics)
                           VALUES (:name, :morion_id, :producer, :barcode, :tnved, :nac, :tax, :sum_com, :sum_dop, :form_prod, :doza, :name_torg,
                              :gran_price, ($sql_m), ($sql_mnn), '1', :amount_in_a_package, :project_dl, :internet_price, :internet_sales, :fix_price, :covid, :covid_protokol, :bonus,
                              :last_modify_author_id, :last_modify_author_id, :insulin, :baby_box, :antibiotics)";
            $sql = $sql_update;

            $del_arg=['id'];
            foreach ($element as $key=>$value){
                if (!in_array($key, $del_arg)){$args[$key] = $value;}
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