<?php

require_once "function.php";
require_once "autoload.php";

is_user_logged_in();

export_mnn_to_file();
download_base('mnn');