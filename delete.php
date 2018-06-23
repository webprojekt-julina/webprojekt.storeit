<?php
include ("connection.php");
$id =$_REQUEST['id'];
$sql = "DELETE FROM webprojekt_dateien WHERE id='$id'";
if(mysqli_query($db, $sql)){
    echo "Die Datei wurde erfolgreich gelöscht";
} else{
    echo "Fehler: Der Befehl konnte nicht ausgeführt werden. $sql" . mysqli_error($link);
}
/**
 * Created by PhpStorm.
 * User: Linus
 * Date: 23.06.2018
 * Time: 16:24
 */