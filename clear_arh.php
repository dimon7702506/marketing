<?php

$folderName = '/samba/public/1C/inv/archive';
$folderName = 'd:\archive';

$now = time();

if (file_exists($folderName)) {
    foreach (new DirectoryIterator($folderName) as $fileInfo) {
        if ($fileInfo->isDot()) {
            continue;
        }
        if ($fileInfo->isFile()) {
            if ($now - $fileInfo->getMTime() >= 5 * 24 * 60 * 60) {
                unlink($fileInfo->getRealPath());
            }
        }
    }
}