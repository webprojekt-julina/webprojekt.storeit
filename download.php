<?php
//https://mars.iuk.hdm-stuttgart.de/~gurzki/dl/download2.php?filename=bild.jpg
$directory = "/home/gurzki/public_html/upload/files";
$mimetype = "image/jpeg";
if(empty($_GET["filename"]))
{
    echo " keine Datei angegeben";
    die();
}
else
{
    $filename=$_GET["filename"];
}
$filepath=$directory.$filename; header("Content-Type:".$mimetype);
header('Content-Disposition: attachment;filename="'.$filename.'"'); header("Content-Transfer-Encoding: binary "); header("Content-Length: ".filesize($filepath)); readfile($filepath);