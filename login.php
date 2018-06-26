<?php
session_start();
include ("connection.php");
// Variablen definieren
$email = $_POST["email"];
$password = $_POST["password"];
$sqlabfrage="SELECT * FROM webprojekt WHERE email='".$_POST["email"]."'";
$ergebnis= $db->query($sqlabfrage);
$queryResults = $ergebnis->fetch(PDO::FETCH_ASSOC);

// Übeprüfung Passwort und Hash-Wert
if(password_verify($password, $queryResults["password"])) {
    $_SESSION["userid"]=$queryResults["userid"];
    include("index.php");
}
// Soll noch schöner werden mit Pop-up Fenster usw.
else { ?>
        <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        <strong>Oh no!</strong> Bei der Anmeldung ist leider ein Fehler aufgetreten. <br>Bitte überprüfe deine Angaben und versuche es erneut.
        </div>
    <?php
    header (" Location: sign_in.html");
}
?>











