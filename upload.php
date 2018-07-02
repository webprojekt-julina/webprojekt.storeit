<?php
session_start();
$dsn="mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-lb107";
try
{
    $db = new PDO($dsn, 'lb107', '#Li1997Bra', array('charset' => 'utf8'));
}
catch (PDOException$p)
{
    echo ("Fehler bei Aufbau der Datenbankverbindung.");
};
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
$name=$_FILES['uploadfile']['name'];
$pfad=$_FILES['uploadfile']['pfad'];
$user_id=$_FILES['uploadfile']['user_id'];
$sql="INSERT INTO dateien (name, pfad, user_id) VALUES('$name','$pfad','$user_id')";
$result=$db ->query($sql);
if($result==TRUE)
    die();
echo 'Datei erfolgreich hochgeladen <a href="'.$new_path.'">'.$new_path. '</a>';

?>