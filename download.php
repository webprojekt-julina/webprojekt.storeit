<?php
$directory = '/home/jt049/public_html/webprojekt.storeit/uploads/files/';
$mimetype = array('image/png', 'image/jpeg', 'image/gif', 'application/pdf', 'application/x-iwork-keynote-sffkey','application/x-iwork-pages-sffpages','application/x-iwork-numbers-sffnumbers','application/vnd.ms-excel','application/msword', 'application/mspowerpoint', 'application/zip');

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