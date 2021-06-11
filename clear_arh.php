<?php

$folderName = '/samba/public/1C/inv/archive';

if (file_exists($folderName)) {
    foreach (new DirectoryIterator($folderName) as $fileInfo) {
        if ($fileInfo->isDot()) {
            continue;
        }
        if ($fileInfo->isFile() && time() - $fileInfo->getCTime() >= 5*24*60*60) {
            unlink($fileInfo->getRealPath());
        }
    }
}