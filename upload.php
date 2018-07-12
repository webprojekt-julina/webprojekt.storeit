<?php
session_start();
include "connection.php";
$userid = $_SESSION ['userid'];

//Variablen definieren
$upload_folder = '/home/jt049/public_html/webprojekt.storeit/uploads/files/'; // Upload-Verzeichnis in Mars
$fileName = pathinfo ($_FILES['uploadfile']['name'], PATHINFO_FILENAME); //Infos über Dateipfad
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
if ($_FILES["uploadfile"]["size"] > 50000000 ) {
    echo "Die Datei ist zu groß(max. Dateigröße:50MB).";
    die ();
}

//Überprüfung der Dateiendung
$allowed_extensions = array('png', 'jpeg','jpg', 'gif', 'pdf', 'key','pages','numbers','xls','doc', 'ppt', 'zip');

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
        $new_path = $upload_folder.$file_name;
        $Anzahl++;
    } while(file_exists($new_path));
}

//Verschieben der Datei an neuen Pfad
$datei= 'datei';
move_uploaded_file($_FILES['uploadfile']['tmp_name'], $new_path);
$name=$_FILES['uploadfile']['name'];
$size=$_FILES['uploadfile']['size'];
$statement= $db ->prepare("INSERT INTO dateien (name,size, user_id) VALUES('$name','$size','$userid')");
$statement ->bindParam(1,$datei);
$statement ->bindParam(2,$name);
$statement ->bindParam(3,$size);
if (!$statement->execute()){
    echo "Datenbank-Fehler:";
    echo $statement->errorInfo()[2];
    echo $statement->queryString;
    die();}
echo 'Datei erfolgreich hochgeladen <a href="'.$new_path.'">'.$new_path. '</a>';

?>