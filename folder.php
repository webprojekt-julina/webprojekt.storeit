<?php
$directory = '/home/jt049/public_html/webprojekt.storeit/uploads/files/';

$folder=$_POST["ordnername"];
$folderpath=$directory.$folder;
if (!file_exists($directory)) {
    mkdir($directory);
}
?>