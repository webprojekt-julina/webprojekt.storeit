<?php
session_start();
include ("connection.php");


//Überprüfung des Dateinamen
echo "Dateiname: ".$_FILES["uploadfile"]["name"]."<br>";
if($_FILES["uploadfile"]["name"]=="")
{
    echo "Fehler Dateiname.";
    die(); }

//Variablen definieren
$upload_folder = '/home/jt049/public_html/webprojekt.storeit/upload/'; // Upload-Verzeichnis
echo "TEMP: ".$FILES["uploadfile"][tmp_name];
$fileName=$_FILES["uploadfile"]["name"];
$extension = strtolower(pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION));
$fileType=substr($fileName,strlen($fileName)-3,strlen($fileName) ); $fileName=substr($fileName,0,strlen($fileName)-4 );
echo "FILENAME:".$fileName."FILETYPE:".$fileType."<br>";

//Überprüfung der Dateigröße
if ($_FILES["uploadfile"]["size"] > 800000) {
    echo"Datei zu groß.";
    die();
}


//Überprüfung der Dateiendung
if ($fileType == "jpg" OR $fileType=="png" OR $fileType== "jpeg" OR $fileType == "gif" OR $fileType=="pdf" OR $fileType== "gif") {
    echo "Dateiart ok<br>";
} else {
    echo"Dateiart nicht zugelassen.";
    die();
}

$new_path = $upload_folder.$fileName.'.'.$extension;
//Neuer Dateiname falls die Datei bereits existiert
if(file_exists($new_path)) {
    //Falls Datei existiert, hänge eine Zahl an den Dateinamen
    $Anzahl = 1;
    do {
        $new_path = $upload_folder.$fileName.$Anzahl.'.'.$extension;
        $Anzahl++;
    } while(file_exists($new_path));
}

//Verschieben der Datei an neuen Pfad
echo $new_path;
move_uploaded_file($_FILES['uploadfile']['tmp_name'], $new_path);

$stmt = $db->prepare("INSERT INTO webprojekt_dateien (id, Wert, Dateiname, user_id) VALUES ('', :Wert, :Dateiname, :user_id)");
$stmt->bindParam(":Wert", $_POST ["Wert"]);
$stmt->bindParam(":Dateiname", $_POST [""]);
$stmt->bindParam(":user_id", $_POST ["user_id"]);

echo 'Bild erfolgreich hochgeladen: <a href="'.$new_path.'">'.$new_path.'</a>';

?>