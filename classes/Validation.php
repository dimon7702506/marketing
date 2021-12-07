<?php

/* Поиск имени пользователя в БД и в случе удачи установка даты последнего входа */

class Validation
{
    public $user_id = 0;
    public $user_role_id = 0;
    public $user_name = '';

    public function __construct($login, $password, $hash)
    {
        $this->valid($login, $password, $hash);
    }

    private function valid($login, $password, $hash)
    {
        $sql = "SELECT id, full_name as name, role_id, apteka_id, email FROM users WHERE email = :login AND password_hash = :password";
        $arg = ["login" => $login,
                "password" => $password];
        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $key =>$val) {
            $this->user_id = (int) $val['id'];
            $this->user_name = $val['name'];
            $this->user_role_id = $val['role_id'];
            $this->apteka_id = $val['apteka_id'];
            $this->user_email = $val['email'];
            //var_dump($val);
        }

        if ($this->user_id > 0) {
            $this->set_last_visit($hash);
        }
    }

    private function set_last_visit($hash)
    {
        $sql = "UPDATE users SET last_visit = :dt, user_hash = :hash WHERE id = :user_id";

        $arg = ["dt" => date("Y-m-d H:i:s"),
                "hash" => $hash,
                "user_id" => $this->user_id];

        $stmt = DB::run($sql, $arg);
    }
}