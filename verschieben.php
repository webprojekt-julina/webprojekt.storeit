<?php
session_start();
include "connection.php";
$userid = $_SESSION ['userid'];

$ordnername = $_POST['ordnername'];

$statement = $db->prepare("SELECT ordnerid FROM ordner WHERE name=? ");
$statement->bindParam(1, $ordnername);
$statement->execute();
while($row=$statement->fetch()) {
   $ordnerid=$row['ordnerid'];
}


//Variablen definieren
if(isset($_GET['filename'])) {
    $dateiname = $_GET['filename'];
    $statement1 = $db->prepare("UPDATE dateien SET ordner_id=? WHERE user_id=? AND name=?");
    $statement1->bindParam(1, $ordnerid);
    $statement1->bindParam(2, $userid);
    $statement1->bindParam(3, $dateiname);
    if (!$statement1->execute()) {
        echo "Datenbank-Fehler:";
        die();
    } else {
        echo 'Datei erfolgreich verschoben';
    }
}
?>