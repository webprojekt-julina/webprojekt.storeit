<?php
$dsn="mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-lb107";
try
{
    $db = new PDO($dsn, 'lb107', '#Li1997Bra', array('charset' => 'utf8'));
}
catch (PDOException$p)
{
    echo ("Fehler bei Aufbau der Datenbankverbindung.");
};