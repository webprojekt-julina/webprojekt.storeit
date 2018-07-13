<?php
session_start();

require ("connection.php");

//Abfrage der Nutzer ID $userid= id des Absenders/Freigebendenn
$userid = $_SESSION['userid'];

if(empty($_GET["dateiname"]))
{
    echo " keine Datei angegeben";
    die();
}
else {
    $dateiname = $_GET["dateiname"];

    $statement = $db->prepare('SELECT * FROM dateien WHERE user_id=? AND name=?');
    $statement->bindParam(1, $userid);
    $statement->bindParam(2, $dateiname);
    $statement->execute();
    while($row=$statement->fetch()) {
        $dateiid=$row['id'];
    }
}

if ($_POST['emailUser']) {
    $email = $_POST['emailUser'];

    $statement1 = $db->prepare('SELECT * FROM webprojekt WHERE email=?');
    $statement1->bindParam(1, $email);
    $statement1->execute();
    while($row=$statement1->fetch()) {
        $empfaengerid=$row['userid'];
    }

    $statement2 = $db->prepare("INSERT INTO teilen (file_id, userid) VALUES ('$dateiid','$empfaengerid')");
    $statement2->bindParam(1, $dateiid);
    $statement2->bindParam(2, $empfaengerid);
    if (!$statement2->execute()) {
        echo "Datenbank-Fehler:";
        die();
    } else {
        echo 'Datei erfolgreich geteilt';?>
        <a href="index.php">Zurück zur Startseite</a>
        <?php
    }
}
//Teilen mit Nicht-Usern
if ($_POST['email-noUser']) {
    $email = $_POST['email-noUser'];
    $subject="Filesharing mit store.it";
    $content= '<html>
                            <head>
                            </head>
                                <body>
                                  <h2>Jemand möchte etwas mit dir teilen...</h2>
                                  <br><br> 
                                  <span> Lade Dir jetzt die für Dich freigegebene Datei herunter.</span>
                                  <a href="https://mars.iuk.hdm-stuttgart.de/~ns109/webprojekt.storeit/extern_download.php?filename=' . $dateiname . '"><button>Einfach hier klicken!</button></a><br><br>
                                  <p>Dein store.it-Team</p> 
                                </body>';
    $header="From: store.it <lb107@hdm-stuttgart>" . "\r\n" . "Reply-to: No Reply" . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=utf-8'. "\r\n". 'X-Mailer: PHP/' . phpversion();
    mail($email, $subject, $content, $header);
    echo 'Datei erfolgreich geteilt';?>
    <a href="index.php">Zurück zur Startseite</a>
    <?php
}

