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

        }

    }
}