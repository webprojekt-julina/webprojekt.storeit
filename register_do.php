<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Willkommen bei store.it</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
    <style>
        p {
            width: auto;
            color: black;


        }
    </style>
</head>
<body>
    <p>
    <?php
    session_start();
    include ("server.php");

    // $showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

    /* Passwort steht noch in URL -> Unbedingt ändern*/

    if(isset($_GET['register'])) {
        $error = false;
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
            $error = true;
        }
        if(strlen($password) == 0) {
            echo 'Bitte ein Passwort angeben<br>';
            $error = true;
        }
        if($password != $password2) {
            echo 'Die Passwörter müssen übereinstimmen<br>';
            $error = true;
        }
        //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
        if(!$error) {
            $statement = $db->prepare("SELECT * FROM webprojekt_user WHERE email = :email");
            $result = $statement->execute(array('email' => $email));
            $email = $statement->fetch();

            if($email !== false) {
                echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
                $error = true;
            }
        }

        //Keine Fehler, wir können den Nutzer registrieren
        if(!$error) {
            $passwort_hash = password_hash($password, PASSWORD_DEFAULT);

            $statement = $db->prepare("INSERT INTO webprojekt_user (name, surname, email, password) VALUES (:name,:surname, :email, :password)");
            $result = $statement->execute(array('name' => $name, 'surname' => $surname, 'email' => $email, 'passwort' => $passwort_hash));

            if($result) {
                echo 'Du wurdest erfolgreich registriert. <a href="sign_in.html">Zum Login</a>';
                $showFormular = false;
            } else {
                echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
            }
        }
    }
?></p>
</body>
</html>