<?php
/* Проверка поля перед выполнинием SQL запроса */

class CheckField
{
    public $value;
    public $error;

    function __construct($field, $val)
    {
        $this->check($field, $val);
    }

    function check($field, $val)
    {
        if(!isset($val)){
            $this->error = 'Incorrect ' . $field;
        }else{
            $this->value = htmlentities($val);

            if ($field == 'name' ||
                $field == 'producer' ||
                $field == 'order_type' ||
                $field == 'date_doc' ||
                $field == 'name_ukr') {
                if (strlen($val) < 1 || strlen($val) > 100) {
                    $this->error = 'Incorrect length of field: ' . $field;
                }
            }elseif ($field == 'doza') {
                if (strlen($val) > 10) {
                    $this->error = 'Incorrect length of field: ' . $field;
                }
            }elseif ($field == 'barcode' || $field == 'tnved') {
                if(strlen($val) > 13){
                    $this->error = 'Incorrect length of field: ' . $field;
                }
            }elseif ($field == 'nac') {
                if($val < 0 || $val > 25) {
                    $this->error = 'Incorrect value of field: ' . $field;
                }
            }elseif ($field == 'tax') {
                if($val != 0 && $val != 7 && $val != 20) {
                    $this->error = 'Incorrect value of field: ' . $field;
                }
            }elseif ($field == 'bonus') {
                if($val < 0 && $val > 100) {
                    $this->error = 'Incorrect value of field: ' . $field;
                }
            }elseif ($field == 'gran_price' || $field == 'sum_com' || $field == 'sum' ||
                    $field == 'internet_price' || $field == 'fix_price'){
                if ($val < 0 || $val > 99999.99) {
                    $this->error = 'Incorrect value of field: ' . $field;
                }
            }elseif ($field == 'name_torg' || $field == 'project_dl') {
                if (strlen($val) > 100) {
                    $this->error = 'Incorrect length of field: ' . $field;
                }
            }elseif ($field == 'form_prod') {
                if (strlen($val) > 68) {
                    $this->error = 'Incorrect length of field: ' . $field;
                }
                //var_dump(($val));
            }elseif ($field == 'morion_id') {
                if ($val < 0 || $val > 99999999999) {
                    $this->error = 'Incorrect value of field: ' . $field;
                }
            }elseif ($field == 'persent'){
                if ($val < 0 || $val > 100) {
                    $this->error = 'Incorrect value of field: ' . $field;
                }
            }elseif ($field == 'amount_in_a_package') {
                if ($val < 0 || $val > 999) {
                    $this->error = 'Incorrect value of field: ' . $field;
                }
            }
        }
    }
}