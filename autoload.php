<?php

spl_autoload_register ('autoload');
function autoload ($className) {
    $base_dir = __DIR__ . '/classes/';

    $fileName = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    if (file_exists($fileName)){
        require_once $fileName;
    }
}