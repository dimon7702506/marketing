<?php

function is_user_logged_in()
{
    return !empty($_SESSION['user_id']);
}

function log_in(int $id, string $login, string $user_name) :void
{
    $_SESSION['user_id'] = (int) $id;
    $_SESSION['login'] = $login;
    $_SESSION['name'] = $user_name;
}

function get_user_name()
{
    if (!is_user_logged_in()) {
        return ' ';
    }
    return /*$_SESSION['user_id'] . " " .*/ $_SESSION['name'];
}

function log_out()
{
    $_SESSION['user_id'] = null;
}

function validation(string $login, string $password) :array
{
    $db = [
        "name" => "marketing",
        "host" => "localhost",
        "port" => "3306",
        "user" => "db_admin",
        "pwd" => "7702506"
    ];
    $dsn = "mysql:dbname=" . $db["name"] . ";host=" . $db["host"] . ";port=" . $db["port"];

    $pdo = new PDO($dsn, $db["user"],$db["pwd"]);

    $sth = $pdo->prepare("SELECT `id`, `name` FROM `user` WHERE `login` = :login AND `password` = :password");
    $sth->execute(["login" => $login, "password" => $password]);
    $data = $sth->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}
