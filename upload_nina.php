<?php
$uploadDir = '/var/www/uploads/';
$uploadFile = $uploadDir . $_FILES['userfile']['name'];
echo "<pre>";
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadFile))
{ echo "Datei ist in Ordnung und Sie wurde erfolgreich hochgeladen.";
    echo "Hier sind die Fehler informationen:\n";
    print_r($_FILES);
}
else
{
    echo "Es wurde ein Fehler gemeldet!\nHier sind die Fehler informationen:\n";
    print_r($_FILES);
}
echo "</pre>";
?>