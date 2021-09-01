<?php

require_once "function.php";
require_once "autoload.php";

is_user_logged_in();

if (isset($_GET['submit_search'])) {
    $text_search = $_GET['search'];
    $find = new SearchFromNamesRemainderList($text_search);
    $nomens = $find->result_data;
    $count = count($nomens);
    setcookie("text_search", $text_search);

}

require_once "./names_remainder.html";