<?php

require_once "./function.php";
require_once "autoload.php";

is_user_logged_in();

$sql = "UPDATE names SET bonus = 0";
$args = [];
$stmt = DB::run($sql, $args);

header("location: admin.php");