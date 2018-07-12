<?php
session_start();
include "connection.php";
$userid = $_SESSION ['userid'];

//Variablen definieren


$upload_folder = '/home/jt049/public_html/webprojekt.storeit/uploads/files/'; // Upload-Verzeichnis in Mars

if(isset($_GET['filename'])) {
    $dateiname = $_GET['filename'];
    $new_path = $upload_folder . $dateiname;

    $statement = $db->prepare("UPDATE dateien SET file_delete=1 WHERE user_id=? AND name=?");
    $statement->bindParam(1, $dateiname);
    $statement->bindParam(2, $userid);
    $statement->execute();
    if (!$statement->execute()){
        echo "Datenbank-Fehler:";
        echo $statement->errorInfo()[2];
        echo $statement->queryString;
        die();}
}

