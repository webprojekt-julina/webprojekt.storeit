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
    die();}
    else {
        echo 'Datei erfolgreich hochgeladen';
        header ("Location: index.php");
    }
?>