<?php
session_start();
include("connection.php");
$userid = $_SESSION ['userid'];

//Variablen definieren
$upload_folder = '/home/jt049/public_html/webprojekt.storeit/uploads/files/'; // Upload-Verzeichnis in Mars
echo "TEMP: ".$_FILES["uploadfile"]["tmp_name"];
$fileName = pathinfo ($_FILES['uploadfile']['name'], PATHINFO_FILENAME); //Infos über Dateipfad
$extension = strtolower(pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION));
$fileType=substr($fileName,strlen($fileName)-3,strlen($fileName) ); $fileName=substr($fileName,0,strlen($fileName)-4 );
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
if ($_FILES["uploadfile"]["size"] > 800000) {
    echo "Die Datei ist zu groß(max. Dateigröße:8MB).";
    die ();
}

//Überprüfung der Dateiendung
$allowed_extensions = array('image/png', 'image/jpeg', 'image/gif', 'application/pdf', 'application/x-iwork-keynote-sffkey','application/x-iwork-pages-sffpages','application/x-iwork-numbers-sffnumbers','application/vnd.ms-excel','application/msword', 'application/mspowerpoint', 'application/zip');

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
$stmt = $db->prepare("INSERT INTO webprojekt_dateien (id, Wert, Dateiname, user_id) VALUES (?,?,(SELECT user_id FROM webprojekt_dateien WHERE user_id=?))");
$stmt->bindParam($file);
$stmt->bindParam($file_name);
$stmt->bindParam($userid);
if (!$stmt->execute()){
    echo "Fehler bei der Datenbankverbindung:";
    echo $stmt->errorInfo();
    echo $stmt ->queryString;
    die();
}
echo 'Datei erfolgreich hochgeladen <a href="'.$new_path.'">'.$new_path. '</a>';
{}
?>