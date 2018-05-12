<?php
session_start();
include ("connection.php");
if(isset($_POST['email']) and isset($_POST['password'])) {
    //$db = new PDO($dsn, 'lb107', '#Li1997Bra', array('charset' => 'utf8'));
    $email = $_POST['email'];
    $password = $_POST['password'];
    echo($email);
    $statement = $db->prepare("SELECT * FROM webprojekt_user WHERE email=:email and password=:password");
    $result = $statement->execute(array(':email' => $email, ':password' => $password));
    $user = $statement->fetch();
    //Überprüfung des Passworts
    if ($user !== false) {
        $_SESSION['password'] = $user['password'];
        die(', dein Login war erfolgreich.');
    } else {
        $errorMessage = ", dein Benutzername oder dein Passwort ist ungültig!<br>";
    }
}
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>