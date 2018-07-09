<?php
session_start();
include "connection.php";
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
$allowed_extensions = array('png', 'jpeg', 'gif', 'pdf', 'keynote','pages','numbers','xls','doc', 'ppt', 'zip');

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



$krpytisch = random_string(); //random new name

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
$datei= 'datei';
move_uploaded_file($_FILES['uploadfile']['tmp_name'], $new_path);
$name=$_FILES['uploadfile']['name'];
$kryptisch=$_FILES['uploadfile']['kryptisch'];
$statement= $db ->prepare("INSERT INTO dateien (name, kryptisch, user_id) VALUES('$name','$kryptisch','$userid')");
$statement ->bindParam(1,$datei);
$statement ->bindParam(2,$name);
$statement ->bindParam(3,$kryptisch);
if (!$statement->execute()){
    echo "Datenbank-Fehler:";
    echo $statement->errorInfo()[2];
    echo $statement->queryString;
    die();}
echo 'Datei erfolgreich hochgeladen <a href="'.$new_path.'">'.$new_path. '</a>';

?>