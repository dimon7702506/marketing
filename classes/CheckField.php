<?php
/* Проверка поля перед выполнинием запроса */

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

            if ($field == 'name' || $field == 'producer') {
                if(strlen($val) < 1 || strlen($val) > 100){
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
            }elseif ($field == 'gran_price' || $field == 'sum_com') {
                if ($val < 0 || $val > 9999.99) {
                    $this->error = 'Incorrect value of field: ' . $field;
                }
            }elseif ($field == 'name_torg') {
                if (strlen($val) > 100) {
                    $this->error = 'Incorrect length of field: ' . $field;
                }
            }elseif ($field == 'form_prod') {
                if (strlen($val) > 20) {
                    $this->error = 'Incorrect length of field: ' . $field;
                }
            }elseif ($field == 'morion_id') {
                if ($val < 0 || $val > 99999999999) {
                    $this->error = 'Incorrect value of field: ' . $field;
                }
            }
        }
    }
}