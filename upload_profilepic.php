<?php
session_start();
require ("connection.php");
$userid = $_SESSION ['userid'];

//Variablen definieren
$upload_folder = '/home/jt049/public_html/webprojekt.storeit/uploads/files/'; // Upload-Verzeichnis in Mars
$fileName = strtolower(pathinfo ($_FILES['uploadfile']['name'], PATHINFO_FILENAME)); //Infos über Dateipfad
$extension = strtolower(pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION));
print_r($_FILES);

//Sicherer Upload

//Überprüfung des Dateinamen
echo "Dateiname: ".$_FILES["uploadfile"]["name"]."<br>";
if($_FILES["uploadfile"]["name"]=="")
{
    echo "Fehlerhafter Dateiname";
    die ();
}

//Überprüfung der Dateigröße
if ($_FILES["uploadfile"]["size"] > 50000000) {
    echo "Die Datei ist zu groß(max. Dateigröße:50MB).";
    die ();
}

//Überprüfung der Dateiendung
$allowed_extensions = array('png', 'jpeg','jpg');

if (!in_array($extension, $allowed_extensions)) {
    echo "Dateiformat nicht zulässig.";
    die ();

}

$new_path = $upload_folder.$fileName.'.'.$extension;

if(file_exists($new_path)) { //Neuer Dateiname falls die Datei bereits existiert
    //Falls Datei existiert, hänge eine Zahl an den Dateinamen
    $Anzahl = 1;
    do {
        $file_name = $fileName."_".$Anzahl.'.'.$extension;
        $new_path = $upload_folder.$fileName.$file_name;
        $Anzahl++;
    } while(file_exists($new_path));
}

//Verschieben der Datei an neuen Pfad
move_uploaded_file($_FILES['uploadfile']['tmp_name'], $new_path);
$bild=$_FILES['uploadfile']['name'];
$new_pb_name=strtolower($bild);
$statement= $db ->prepare("UPDATE webprojekt SET bild=? WHERE userid=$userid ");
$statement ->bindParam(1,$new_pb_name);
if (!$statement->execute()){
    echo "Datenbank-Fehler:";
    echo $statement->errorInfo()[2];
    echo $statement->queryString;
    die();}
echo 'Datei erfolgreich hochgeladen <a href="'.$new_path.'">'.$new_path. '</a>';
header ("Location: index.php");


?>