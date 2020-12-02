<?php

require_once "function.php";

is_user_logged_in();

export_names_base_to_file('updates');
download_names_base();