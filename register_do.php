<?php
session_start();
include ("connection.php");
?>
    <!doctype html>
    <html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">

        <title>Registrierung</title>

        <!-- Bootstrap core CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="signin.css" rel="stylesheet">
        <style>
            a {
                text-decoration: none;
                display: inline-block;
                color: white;
            }
            .block {
                display: block;
                flex-direction: row;
                float: left;
                width: 15%;
                border: none;
                background-color: #007bff;
                padding: 10px;
                font-size: 14px;
                cursor: pointer;
                border-radius: 7px;
            }
            a:hover{
                color: white;
                text-decoration: none;
                background-color: #0069d9;
            }
        </style>
    </head>

<?php
    $showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
    /* Passwort steht noch in URL -> Unbedingt ändern*/

    if(isset($_GET['register'])) {
        $error = false;
        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        if ($password != $password2) {
            echo 'Die Passwörter müssen übereinstimmen<br>';
            $error = true;
        }
        //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
        if (!$error) {
            $statement = $db->prepare("SELECT * FROM webprojekt WHERE email = :email");
            $result = $statement->execute(array('email' => $email));
            $email = $statement->fetch();

            if ($email !== false) {
                echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
                $error = true;
            }
        }
        //Keine Fehler, wir können den Nutzer registrieren
        if (!$error) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $statement = $db->prepare("INSERT INTO webprojekt (firstname, surname, email, password, ) VALUES (:firstname, :surname, :email, :password )");
            $result = $statement->execute(array('firstname' => $firstname, 'surname' => $surname, 'email' => $email, 'password' => $password_hash));

            if ($result) {
                echo 'Du wurdest erfolgreich registriert. <a href="sign_in.html">Zum Login</a>';
            } else {
                echo 'Bei der Registrierung ist leider ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.<br>';
            }
        }
    }
if($showFormular) {
    ?>
    <body class="text-center">
    <div class="page-header">
        <h1 id="h1register" class="h1 mb-3 font-weight-bold-underline">Registrierung</h1>
    </div>
    <a class="block" href="sign_in.html">&laquo; Zurück zur Anmeldung</a><br>
    <form action="?register=1" class="form-signin" method="post">
        <h2 class="h3 mb-3 font-weight-normal">Erstelle ein neues Konto</h2>
        <br>
        <label for="inputName" class="sr-only">Vorname</label>
        <input type="text" id="inputName" class="form-control" placeholder="Vorname" name="firstname" required autofocus>
        <br>
        <label for="inputSurname" class="sr-only">Nachname</label>
        <input type="text" id="inputSurname" class="form-control" placeholder="Nachname" name="surname"  required autofocus>
        <br>
        <label for="inputEmail" class="sr-only">E-Mail Addresse</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="E-Mail Addresse" name="email" required autofocus>
        <br>
        <label for="inputPassword" class="sr-only">Neues Passwort</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Neues Passwort" name="password" required>
        <br>
        <label for="inputPassword" class="sr-only">Neues Passwort bestätigen</label>
        <input type="password" id="inputPassword2" class="form-control" placeholder="Neues Passwort bestätigen" name="password2"required>
        <br>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Registrieren</button>
    </form>
    <footer>
        <a class="container" id="data" href="data.html">Datenschutz</a><br>
        <a class="container" id="impressum" href="impressum.html">Impressum</a><br>
    </footer><br><br>
    <p id="copyright">&copy;Webprojekt 2017-2018</p>
    <?php
    } //Ende von if($showFormular)
?>
