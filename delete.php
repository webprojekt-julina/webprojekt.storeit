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
        echo("Datei $dateiname wurde erfolgreich endgültig gelöscht");
        header ("Location: trash.php");
    }}


if(isset($_GET['ordnerid'])) {
    $ordnerid = $_GET['ordnerid'];
    $statement1 = $db->prepare("DELETE FROM ordner WHERE ordnerid=? AND user_id=?");
    $statement1->bindParam(1,$ordnerid );
    $statement1->bindParam(2,$userid);
    if (!$statement1->execute()) {
        echo "Datenbank-Fehler:";
        die();
    } else {
        echo("Ordner $ordnerid wurde erfolgreich endgültig gelöscht");
        header ("Location: trash.php");
    }
}
?>