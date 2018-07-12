<?php
session_start();

require ("connection.php");
if(!isset($_SESSION['userid'])) {
    die( require_once("sign_in_nosession.html"));
}

//Abfrage der Nutzer ID $userid= id des Absenders/Freigebenden
$userid = $_SESSION['userid'];

if (isset($_GET['file_id'])) {
    $dateiid = $_GET['file_id'];
    $delete = $_POST['delete'];
    if ($delete != '1') {
        $delete = '0';
    }

    $statement = $db->prepare('SELECT * FROM dateien WHERE user_id=? AND id=?');
    $statement->bindParam(1, $userid);
    $statement->bindParam(2, $dateiid);
    $statement->execute();
    if ($statement->rowCount() != 0) {
        $ergebnis=$statement->fetch();

        $statement = $db->prepare('UPDATE dateien SET freigabe=? WHERE id=?');   // Button Nicht-User
        $statement->bindParam(1, $freigabe);
        $statement->bindParam(2, $dateiid);
        $statement->execute();

        if (strlen($_POST['email-noUser']) > 4) {   //Teilen mit Nicht-Usern WIESO 4?????
            $email = $_POST['email-noUser'];
            $dateiname = $ergebnis['name'];
            mail($email, 'Filesharing mit store.it', 'Hallo! Lade Dir jetzt diese für Dich freigegebene Datei herunter. <br><br> <a href="https://mars.iuk.hdm-stuttgart.de/' . $dateiname . '">Einfach hier klicken!</a><br><br> Dein store.it-Team', [
                'MIME-Version: 1.0','Content-type: text/html; charset=iso-8859-1']);


            //Teilen mit NutzerInnen -->
        }

        if (strlen($_POST['emailUser']) > 4) {
            $email = $_POST['emailUser'];

            $statement = $db->prepare('SELECT id FROM webprojekt WHERE email=?');
            $statement->bindParam(1, $email);
            $statement->execute();
            if ($statement->rowCount() != 0) {
                $empfaengerrid = $statement->fetch()['userid'];

                //Freigabeüberprüfung
                $statement = $db->prepare('SELECT * FROM teilen WHERE userid=? AND file_id=?');
                $statement->bindParam(1, $empfaengerrid);
                $statement->bindParam(2, $dateiid);
                $statement->execute();
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
