<?php
/* Проверка поля перед записью в БД
   вместо  CheckField*/

class CheckFields
{
    public $value;
    public $error;

    function __construct($field_name, $type, $min, $max, $length, $val)
    {
        $this->check($field_name, $type, $min, $max, $length, $val);
    }


    function check($field_name, $type, $min, $max, $length, $val)
    {
        if(!isset($val)){
            $this->error = 'Incorrect ' . $field_name;
        }else {
            if($type == 'textarea') {
                $this->value = ($val);
            }else{
                $this->value = htmlentities($val);
            }

            if ($type == 'text') {
                if (strlen($val) < $min || strlen($val) > $length) {
                    $this->error = 'Не корректное поле: ' . $field_name . '<br>';
                }
            }elseif ($type == 'number') {
                if ($val < $min || $val > $max) {
                    $this->error = 'Не корректное поле: ' . $field_name . '<br>';
                }
            }elseif ($type == 'date') {}
        }
    }
}