<?php
session_start();

require ("connection.php");
if(!isset($_SESSION['userid'])) {
    die( require_once("sign_in_nosession.html"));
}
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
    if ($statement->rowCount() != 0) {
        $dateiid=$statement->fetch()['id'];

        $statement = $db->prepare('INSERT INTO teilen (file_id, userid) VALUES (?,?)');   // Button Nicht-User
        $statement->bindParam(1, $freigabe);
        $statement->bindParam(2, $dateiname);
        $statement->execute();

//Teilen mit Nicht-Usern
         if (strlen($_POST['email-noUser']) > 6) {
             $email = $_POST['email-noUser'];
             $subject="Filesharing mit store.it";
             $content= '<html>
                            <head>
                            </head>
                                <body>
                                  <h2>Jemand möchte etwas mit dir teilen...</h2>
                                  <br><br> 
                                  <span> Lade Dir jetzt die für Dich freigegebene Datei herunter.</span>
                                  <a href="https://mars.iuk.hdm-stuttgart.de/~lb107/webprojekt.storeit/download.php?dateiname=' . $dateiname . '"><button>Einfach hier klicken!</button></a><br><br>
                                  <p>Dein store.it-Team</p> 
                                </body>';
             $header="From: store.it <lb107@hdm-stuttgart>" . "\r\n" . "Reply-to: No Reply" . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=utf-8'. "\r\n". 'X-Mailer: PHP/' . phpversion();
             mail($email, $subject, $content, $header);
         }
//Teilen mit Nutzern  -->
        if (strlen($_POST['emailUser']) > 6) {
            $email = $_POST['emailUser'];

            $statement = $db->prepare('SELECT * FROM webprojekt WHERE email=?');
            $statement->bindParam(1, $email);
            $statement->execute();
            if ($statement->rowCount() != 0) {
                $empfaengerrid = $statement->fetch()['userid'];

                echo $dateiid;
                //Freigabeüberprüfung
                $statement = $db->prepare('SELECT * FROM teilen WHERE userid=? AND file_id=?');
                $statement->bindParam(1, $empfaengerrid);
                $statement->bindParam(2, $dateiid);
                $statement->execute();
                $ergebnis=$statement->fetch();
                //var_dump($ergebnis);
                if ($statement->rowCount() == 0) {

                    $statement = $db->prepare('INSERT INTO teilen (file_id, userid) VALUES (?,?)');
                    $statement->bindParam(1, $dateiid);
                    $statement->bindParam(2, $empfaengerrid);
                    $statement->execute();
                }
            }
        }
    }
}
