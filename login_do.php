<?php
$dsn="mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-lb107";
session_start();
if(isset($_POST['login']) and isset($_POST['password'])) {
    $db = new PDO($dsn, 'lb107', '#Li1997Bra', array('charset' => 'utf8'));
    //$userid = $_POST['user_id'];
    $login = $_POST['email'];
    $password = $_POST['password'];
    echo($login);

    $statement = $db->prepare("SELECT * FROM webprojekt WHERE email=:email and password=:password");
    $result = $statement->execute(array(':email' => $login, ':password' => $password));
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