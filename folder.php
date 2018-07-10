<?php
session_start();
include "connection.php";
$userid = $_SESSION ['userid'];

$name=$_POST['ordnername'];
$statement= $db ->prepare("INSERT INTO ordner (name, user_id) VALUES('$name','$userid')");
$statement ->bindParam(1,$name);
$statement ->bindParam(2,$userid);
if (!$statement->execute()){
    echo "Datenbank-Fehler:";
    echo $statement->errorInfo()[1];
    echo $statement->queryString;
    die();}
echo 'Datei erfolgreich hochgeladen';


/*$directory = '/home/jt049/public_html/webprojekt.storeit/uploads/files/';

$folder=$_POST["ordnername"];
$folderpath=$directory.$folder;

if (!file_exists($folderpath)) {
    mkdir($folderpath);
}*/
?>