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
    $_SESSION["email"]=$queryResults["email"];
    include("index.html");
}
// Soll noch schöner werden mit Pop-up Fenster usw.
else {
    echo "Ihre Angaben sind leider nicht korrekt, versuchen Sie es erneut! Zurück zur <a href=\"sign_in.html\">Anmeldung</a>!";
}
?>











