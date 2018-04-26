<?php

/* Поиск имени пользователя в БД и в случе удачи установка даты последнего входа */

class Validation
{
    public $user_id = 0;
    public $user_role_id = 0;
    public $user_name = '';

    public function __construct($login, $password)
    {
        $this->valid($login, $password);
    }

    private function valid($login, $password)
    {
        $sql = "SELECT id, name, role_id, apteka_id FROM users WHERE login = :login AND password = :password";
        $arg = ["login" => $login, "password" => $password];
        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $key =>$val) {
            $this->user_id = (int) $val['id'];
            $this->user_name = $val['name'];
            $this->user_role_id = $val['role_id'];
            $this->apteka_id = $val['apteka_id'];
        }

        if ($this->user_id > 0) {
            $this->set_last_visit();
        }
    }

    private function set_last_visit()
    {
        $sql = "UPDATE users SET last_visit = :dt WHERE id = :user_id";
        $arg = ["dt" => date("Y-m-d H:i:s"), "user_id" => $this->user_id];
        $stmt = DB::run($sql, $arg);
    }
}