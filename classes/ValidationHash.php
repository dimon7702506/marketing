<?php

class ValidationHash
{
    public function __construct($user_id, $hash)
    {
        $this->valid($user_id, $hash);
    }

    private function valid($user_id, $hash)
    {
        $sql = "SELECT id, user_hash FROM users WHERE id = :user_id AND user_hash = :hash";

        $arg = ["user_id" => $user_id,
                "hash" => $hash];

        $stmt = DB::run($sql, $arg);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $key =>$val) {
            $this->user_id = (int) $val['id'];
            $this->user_hash = $val['user_hash'];
        }
    }
}