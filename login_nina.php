<?php
session_start();
include ("connection.php");
// Abfräge
if(!isset($_POST["email"]) OR !isset($_POST["password"]))
{
    echo"Fehler";
    die();
}
echo $_POST["email"];
echo $_POST["password"];

$sqlabfrage="SELECT * FROM webprojekt WHERE password='".$_POST["password"]."' AND email='".$_POST["email"]."'";

$ergebnis= $db->query($sqlabfrage);

if($row= $ergebnis->fetch(PDO::FETCH_ASSOC)) {

    echo "user angenmeldet";
    $_SESSION["email"]=$row["email"];
    $_SESSION["password"]=$row["password"];
}
?>











