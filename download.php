<?php

$directory = "/home/ns109/public_html/webprojekt.storeit/uploads/files/";
$mimetype = "image/png";
if(empty($_GET["name"]))
{
    echo " keine Datei angegeben";
    die();
}
else
{
    $filename=$_GET["name"];
}
$filepath=$directory.$filename;
header("Content-Type:".$mimetype);
header('Content-Disposition: attachment;name="'.$filename.'"');
header("Content-Transfer-Encoding: binary ");
header("Content-Length: ".filesize($filepath));
readfile($filepath);