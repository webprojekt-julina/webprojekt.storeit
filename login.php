<?php
session_start();
include ("connection.php");

function random_string() {
    if(function_exists('random_bytes')) {
        $bytes = random_bytes(16);
        $str = bin2hex($bytes);
    } else if(function_exists('openssl_random_pseudo_bytes')) {
        $bytes = openssl_random_pseudo_bytes(16);
        $str = bin2hex($bytes);
    } else if(function_exists('mcrypt_create_iv')) {
        $bytes = random_bytes(16, MCRYPT_DEV_URANDOM);
        $str = bin2hex($bytes);
    } else {
        //Bitte euer_geheim_string durch einen zufälligen String mit >12 Zeichen austauschen
        $str = md5(uniqid('RUSbDPQPhFpL', true));
    }
    return $str;
}
// Variablen definieren
$email = $_POST["email"];
$password = $_POST["password"];
$sqlabfrage="SELECT * FROM webprojekt WHERE email='".$_POST["email"]."'";
$ergebnis= $db->query($sqlabfrage);
$queryResults = $ergebnis->fetch(PDO::FETCH_ASSOC);

// Übeprüfung Passwort und Hash-Wert
if(password_verify($password, $queryResults["password"])) {
    $_SESSION["userid"]=$queryResults["userid"];
    header ('Location: index.php');
}
else { ?>
    <?php
    header
('Location: sign_in_failed.html');
}
?>












