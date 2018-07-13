<?php

require_once "function.php";
require_once "autoload.php";

export_names_base_to_file('all');
export_marketings_base_to_file();
export_mnn_to_file();

require_once "send.php";