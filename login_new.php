<?php
session_start();
include ("connection.php");

// Abfrage
if(!isset($_POST["email"]) OR !isset($_POST["password"]))
{
    echo"Der Login ist fehlgeschlagen, versuchen Sie es erneut!";
    die();
}
echo $_POST["email"];
echo $_POST["password"];

$dsn="mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-lb107";

try
{
    $db = new PDO($dsn, 'lb107', '#Li1997Bra', array('charset' => 'utf8'));
}
catch (PDOException$p)
{
    echo ("Fehler bei Aufbau der Datenbankverbindung.");
}

$sqlabfrage="SELECT * FROM webprojekt WHERE password='".$_POST["password"]."' AND login='".$_POST["login"]."'";

$ergebnis= $db->query($sqlabfrage);

if($row= $ergebnis->fetch(PDO::FETCH_ASSOC)) {

    echo "user angenmeldet";
    $_SESSION["user"]=$row["id"];
    $_SESSION["login"]=$row["login"];
}
?>


