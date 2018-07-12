<?php
session_start();
include "connection.php";
$userid = $_SESSION ['userid'];

//Variablen definieren
if(isset($_GET['filename'])) {
    $dateiname = $_GET['filename'];
    $statement = $db->prepare("UPDATE dateien SET file_delete=1 WHERE user_id=? AND name=?");
    $statement->bindParam(1, $userid);
    $statement->bindParam(2, $dateiname);
    if (!$statement->execute()) {
        echo "Datenbank-Fehler:";
        die();
    } else {
        echo 'Datei erfolgreich gelöscht';
    }
}
if(isset($_GET['ordnerid'])) {
    $ordnerid = $_GET['ordnerid'];
    $statement1 = $db->prepare("UPDATE ordner SET file_delete=1 WHERE user_id=? AND ordnerid=?");
    $statement1->bindParam(1, $userid);
    $statement1->bindParam(2, $ordnerid);
    if (!$statement1->execute()) {
        echo "Datenbank-Fehler:";
        die();
    } else {
        echo 'Datei erfolgreich gelöscht';
    }
}
?>