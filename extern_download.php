<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die( include("sign_in_nosession.html"));
}

//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];

$directory = '/home/jt049/public_html/webprojekt.storeit/uploads/files/';
$mimetype = array(
    'png' => array('image/png'),
    'jpeg' => array('image/jpeg', 'image/pjpeg'),
    'gif' => array('image/gif'),
    'pdf' => array('application/pdf'),
    'keynote' => array('application/x-iwork-keynote-sffkey'),
    'pages' => array('application/x-iwork-pages-sffpages'),
    'numbers' => array('application/x-iwork-numbers-sffnumbers'),
    'application/vnd.ms-excel',
    'application/msword',
    'application/mspowerpoint',
    'application/zip');

    if (empty($_GET["filename"])) {
        echo " keine Datei angegeben";
        die();
}
else
{
    $filename=$_GET["filename"];
}
$filepath=$directory.$filename;
header("Content-Type:".$mimetype);
header('Content-Disposition: attachment;filename="'.$filename.'"');
header("Content-Transfer-Encoding: binary ");
header("Content-Length: ".filesize($filepath));
readfile($filepath);

?>