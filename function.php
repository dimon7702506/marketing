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