<?php

require_once "autoload.php";

$read_file = new ReadFile('/var/www/marketing.com/temp/morion_base_id.csv');
$file = $read_file ->out;
//var_dump($file);

foreach ($file as $f){
  //var_dump($f);
    $id = (int) $f[0];
    $name = $f[1];
    $name = str_replace('?','i', $name);

    $save = new SaveUkrNamesToDB($id, $name);
}
