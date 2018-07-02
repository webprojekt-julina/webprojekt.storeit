<?php
session_start();
if(!isset($_SESSION['userid'])) {
    die( include("sign_in_nosession.html"));
}

//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];

if(isset($_REQUEST["file"])){
    // Get parameters
    $file = urldecode($_REQUEST["file"]); // Decode URL-encoded string
    $filepath = '/home/jt049/public_html/webprojekt.storeit/uploads/files/'.$file;
    $mimetype = array(
        'png' => array('image/png'),
        'jpeg' => array('image/jpeg', 'image/pjpeg'),
        'gif' => array('image/gif'),
        'pdf' => array('application/pdf'),
        'keynote' => array('application/x-iwork-keynote-sffkey'),
        'pages' => array('application/x-iwork-pages-sffpages'),
        'numbers' => array('application/x-iwork-numbers-sffnumbers'),
        'application/vnd.ms-excel',
        'application/msword',
        'application/mspowerpoint',
        'application/zip');

    // Process download
    if(file_exists($filepath)) {
        header("Content-Type:".$mimetype);
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header("Content-Transfer-Encoding: binary ");
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
    }
    else {
        echo "Fehlgeschlagen";
    }
}
?>