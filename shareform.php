<?php
//Session
session_start();
if(!isset($_SESSION['userid'])) {
    die( require_once("sign_in_nosession.html"));
}
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Datei teilen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
    <style>
        body {
            font-family: "Open sans", "Segoe UI", "Segoe WP", Helvetica, Arial, sans-serif;
            color: #515151;
            background: #FCFDFD;
        }
        #sm {
            margin-bottom: 3%;
            font-weight: normal;
            text-align: center;
            color: #007bff;
        }
        form {
            width: 225px;
            margin: 0 auto;
            text-align:center;
        }
       .txtcenter {
            margin-top: 5%;
            font-size: 1.2em;
            text-align: center;
            color: #515151;
        }
    </style>
</head>

<body class="text-center">
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">store.it</a>
    <input class="form-control form-control-dark w-10 search" type="text" placeholder="Search" aria-label="Search">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Hallo, <?php require ("connection.php");$sqls = "SELECT firstname FROM webprojekt WHERE userid=$userid"; foreach ($db->query($sqls) as $rows) { echo $rows['firstname']; } ?>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="settings.php"><?php require ("connection.php");$sqls1 = "SELECT bild FROM webprojekt WHERE userid=$userid"; foreach ($db->query($sqls1) as $row) ?></a>
            <?php
            $directory="/home/jt049/public_html/webprojekt.storeit/uploads/files/";
            $filename= $row['bild'];
            $filepath=$directory.$filename;
            ?>
            <a class="dropdown-item" href="#"><img src='<?="$filepath"?>' width="50px" height="80px"</a>
            <a class="dropdown-item" href="settings.php">Einstellungen</a>
            <a class="dropdown-item" href="logout.php">Abmelden</a>
        </div>
    </div>
</nav>
<div class='txtcenter' id="share">
    <br>
    <h2 id="sm">Teile Dateien mit anderen Personen</h2>
    <p>Mit anderen registrierten Nutzern teilen:</p>
    <?php $dname= $_GET['dateiname'] ?>
        <form action="share1.php?dateiname=<?= $dname ?>" method="post">
                <div class='input-group'>
                <input type='email' name='emailUser' class='form-control' placeholder='E-Mail Addresse' required>
            </div>
            <button type='submit' value='Teilen' name='subUser' class='btn btn-primary'>
                    <i class='fa fa-share'></i> Teilen
                </button>
            <!--------------------------   Nicht registrierte Benutzer ----------------->
            <br>
            <br>
            <br>
            <p>Mit nicht-registrierten Personen teilen:</p>
            <div class='input-group'>
                <input type='email' name='email-noUser' class='form-control' placeholder='E-Mail-Adresse' required>
            </div>
            <button type='submit' value='Teilen' name='subNUser'
                        class='btn btn-primary'><i class='fa fa-share'></i> Teilen
                </button>
        </form>
</div>
<script>
    document.querySelector("html").classList.add('js');

    var fileInput  = document.querySelector( ".input-file" ),
        button     = document.querySelector( ".input-file-trigger" ),
        the_return = document.querySelector(".file-return");

    button.addEventListener( "keydown", function( event ) {
        if ( event.keyCode == 13 || event.keyCode == 32 ) {
            fileInput.focus();
        }
    });
    button.addEventListener( "click", function( event ) {
        fileInput.focus();
        return false;
    });
    fileInput.addEventListener( "change", function( event ) {
        the_return.innerHTML = this.value;
    });
</script>
<!-- Bootstrap core JavaScript
================================================== -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>

<!-- jQuery für Teilen - ein 'input' required zum abschicken des Formulars--->
<script> jQuery(function ($) {
        var $inputs = $('input[name=emailUser],input[name=email-noUser]');
        $inputs.on('input', function () {
            $inputs.not(this).prop('required', !$(this).val().length);
        });
    });
</script>

<!-- script für die dropdowns-->
<script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
</script>

<!-- Script für Upload & Download-->
<script>
    function myFunction() {
        var x = document.createElement("INPUT");
        x.setAttribute("type", "file");
        document.body.appendChild(x);
    }
</script>
</body>
</html>
