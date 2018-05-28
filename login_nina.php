<?php
session_start();
include ("connection2.php");
// Abfrage

$sqlabfrage="SELECT * FROM webprojekt WHERE password='".$_POST["password"]."' AND email='".$_POST["email"]."'";

$ergebnis= $db->query($sqlabfrage);

if($row= $ergebnis->fetch(PDO::FETCH_ASSOC)) {
    session_start();
    $_SESSION["email"]=$row["email"];
    $_SESSION["password"]=$row["password"];
    include("index.html");
}
else {
    echo "Ihre Angaben sind leider nicht korrekt, versuchen Sie es erneut!";
}

?>











