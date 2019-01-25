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
        //var_dump($val);

        if(!isset($val)){
            $this->error = 'Incorrect ' . $field_name;
        }else{
            $this->value = htmlentities($val);

            if($type == 'text'){
                if(strlen($val) < 1 || strlen($val) > $length){
                    $this->error = 'Не корректная длина поля: ' . $field_name;
                }
            }elseif ($type == 'number'){
                if($val < $min || $val > $max) {
                    $this->error = 'Не корректная длина поля: ' . $field_name;
                }
            }elseif ($type == 'date'){

            }
        }
    }
}