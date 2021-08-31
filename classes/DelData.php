<?php

class DelData
{
    public $result_data;

    public function __construct($sp_type)
    {
        $this->del($sp_type);
    }

    public function del($sp_type)
    {
        if ($sp_type == 'remainder'){
            $table_name = 'remainder';
        }

        $sql = "DELETE FROM $table_name";

        $stmt = DB::run($sql);
    }
}