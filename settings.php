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

    <title>Einstellungen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
    <link href="settings.css" rel="stylesheet">


</head>

<body>
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
<div id="settings">
    <h1 id="lg">Einstellungen</h1>  <br><br>
    <h2 id="sm">Lade dein persönliches Profilbild hoch</h2>
    <p class="txtcenter"><b>Achtung!</b><br />Die maximale Größe beträgt 50 MB.</p><br>
    <form action="upload_profilepic.php" method="post"
              enctype="multipart/form-data">
            <input type="file" name="uploadfile"
                   id="uploadfile"><br>
            <input type="submit" value="Datei hochladen" name="submit">
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

