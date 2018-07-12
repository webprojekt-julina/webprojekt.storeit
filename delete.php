<?php
session_start();
include "connection.php";
$userid = $_SESSION ['userid'];

//Variablen definieren


$upload_folder = '/home/jt049/public_html/webprojekt.storeit/uploads/files/'; // Upload-Verzeichnis in Mars

if(isset($_GET['filename'])){
    $dateiname = $_GET['filename'];
    $new_path = $upload_folder.$dateiname;

    $statement= $db ->prepare("DELETE FROM dateien WHERE name=? AND user_id=?");
    $statement ->bindParam(1,$dateiname);
    $statement ->bindParam(2,$userid);
    $statement ->execute();
    if (!unlink($new_path)){
        echo ("Datei $dateiname konnte nicht gelöscht werden!");
    }
    else {
        echo("Datei $dateiname wurde erfolgreich gelöscht");
    }}
