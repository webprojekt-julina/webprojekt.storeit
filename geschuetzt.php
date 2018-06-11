<?php
session_start();
if(!isset($_SESSION['email'])) {
    die('Bitte zuerst <a href="sign_in.html">einloggen</a>');
}

//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['email'];

echo "Hallo User: ".$userid;
?>