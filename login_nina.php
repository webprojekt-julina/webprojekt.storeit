<?php
session_start();
include ("connection.php");
// Abfrage

$sqlabfrage="SELECT * FROM webprojekt WHERE password='".$_POST["password"]."' AND email='".$_POST["email"]."'";

$ergebnis= $db->query($sqlabfrage);

if($row= $ergebnis->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION["email"]=$row["email"];
    $_SESSION["password"]=$row["password"];
    include("dashboard/index.html");
}
else {
    echo "Ihre Angaben sind leider nicht korrekt, versuchen Sie es erneut!";
}

?>











