<?php
session_start();
require ("connection.php");
$userid = $_SESSION ['userid'];

//Variablen definieren
$upload_folder = '/home/jt049/public_html/webprojekt.storeit/uploads/files/'; // Upload-Verzeichnis in Mars
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
if ($_FILES["uploadfile"]["size"] > 50000000) {
    echo "Die Datei ist zu groß(max. Dateigröße:50MB).";
    die ();
}

//Überprüfung der Dateiendung
$allowed_extensions = array('png', 'jpeg', 'jpg');

if (!in_array($extension, $allowed_extensions)) {
    echo "Dateiformat nicht zulässig.";
    die ();
}

function random_string() {
    if(function_exists('random_bytes')) {
        $bytes = random_bytes(16);
        $str = bin2hex($bytes);
    } else if(function_exists('openssl_random_pseudo_bytes')) {
        $bytes = openssl_random_pseudo_bytes(16);
        $str = bin2hex($bytes);
    } else if(function_exists('mcrypt_create_iv')) {
        $bytes = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
        $str = bin2hex($bytes);
    } else {
        //Bitte euer_geheim_string durch einen zufälligen String mit >12 Zeichen austauschen
        $str = md5(uniqid('6hfjlkbf358saumf401', true));
    }
    return $str;
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
$statement= $db ->prepare("UPDATE webprojekt SET bild='$bild' WHERE userid=$userid ");
$statement ->bindParam(1,$bild);
if (!$statement->execute()){
    echo "Datenbank-Fehler:";
    echo $statement->errorInfo()[2];
    echo $statement->queryString;
    die();}
echo 'Datei erfolgreich hochgeladen <a href="'.$new_path.'">'.$new_path. '</a>';

?>