<?php

require_once "./function.php";
require_once "autoload.php";

is_user_logged_in();

if (isset($_GET['sp_type'])){$sp_type = $_GET['sp_type'];}
if (isset($_GET['id'])){$id = $_GET['id'];}

if ($sp_type == 'invoices') {
    $element['id'] = $id;
    $element['invoice_status_id'] = 2;
    $save = new SetData('invoices', $element, 'update');
}

header("location: ./elem.php?id=$id&sp_type=$sp_type");