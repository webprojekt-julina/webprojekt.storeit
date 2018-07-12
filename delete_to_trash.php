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
?>