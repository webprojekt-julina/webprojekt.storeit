<?php
//Session
session_start();
if(!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="sign_in.html">einloggen</a>');
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

    <title>Dashboard Template for Bootstrap</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">store.it</a>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Neu
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
            <a class="dropdown-item" href="#">Ordner erstellen</a>
            <a class="dropdown-item" href="#">Datei hochladen
                <form action="upload.php" method="post"
                      enctype="multipart/form-data">
                    <input type="file" name="uploadfile"
                           id="uploadfile"><br>
                    <input type="submit" value="Datei hochladen" name="submit">
                </form>
            </a>
            <a class="dropdown-item" href="#">Ordner hochladen</a>
        </div>
    </div>
    <input class="form-control form-control-dark w-10 search" type="text" placeholder="Search" aria-label="Search">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Hallo, <?php require ("connection.php");$sqls = "SELECT firstname FROM webprojekt WHERE userid=$userid"; foreach ($db->query($sqls) as $rows) { echo $rows['firstname']; } ?>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#"><img src="Platzhalter.jpeg" width="20px" height="30px"</a>
            <a class="dropdown-item" href="#">Einstellungen</a>
            <a class="dropdown-item" href="logout.php">Abmelden</a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href=index.php>
                            <span data-feather="home"></span>
                            Alle Dateien <span class="sr-only"></span>
                        </a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href=latest.php>
                            <span data-feather="clock"></span>
                            Aktuell
                        </a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link" href=favourite.php>
                            <span data-feather="star"></span>
                            Favoriten
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=my_files.php>
                            <span data-feather="user"></span>
                            Meine Uploads
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=files_for_me.php>
                            <span data-feather="users"></span>
                            Für Mich freigegeben
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=trash.php>
                            <span data-feather="trash-2"></span>
                            Papierkorb
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Meine Dateien</h1>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sortieren nach
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                        <a class="dropdown-item" href="#">Name</a>
                        <a class="dropdown-item" href="#">Änderungsdatum</a>
                        <a class="dropdown-item" href="#">Eigentümer</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <?php
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th> Name </th>";
                        echo "<th> Dateigröße</th>";
                        echo "</thead>";
                        require ("connection.php");
                        $sql = "SELECT name FROM dateien WHERE user_id=$userid";
                        foreach ($db->query($sql) as $row)
                        {
                            echo "<tbody>";
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "</tr>";
                            echo "</tbody>";
                        }; ?>
                    </table>
                </div>
        </main>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
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
