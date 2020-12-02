<?php

require_once "function.php";
require_once "autoload.php";

is_user_logged_in();

export_names_base_to_file('all');
download_names_base();