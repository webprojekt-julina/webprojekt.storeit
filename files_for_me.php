<?php
//Session jetzt starteen
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

    <title>Für mich freigegeben</title>
    <link rel="icon" type="image/png" href="logo_neu.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-light flex-md-nowrap p-0 shadow" style="background-color: rgb(67,140,202);">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php" style="background-color: rgb(67,140,202); color: #ffffff;">store.it</a>
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Neu
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
            <a class="dropdown-item" href="#">
                <form action="folder.php" method="post">
                    <p> <input type="text" name="ordnername" placeholder="Benenne deinen Ordner" required/> <input type="submit" value="Ordner erstellen"/>
                    </p>
                </form>
            </a>

            <a class="dropdown-item" href="#">
                <form action="upload.php" method="post"
                      enctype="multipart/form-data">
                    <input type="file" name="uploadfile"
                           id="uploadfile"><br>
                    <input type="submit" value="Datei hochladen" name="submit">
                </form>
            </a>
        </div>
    </div>
    <input class="form-control form-control-dark w-10 search" aria-label="Search">

    <?php require ("connection.php");
    $sqls1 = "SELECT bild FROM webprojekt WHERE userid=$userid";
    foreach ($db->query($sqls1) as $row) ?>
    <?php
    $directory="https://mars.iuk.hdm-stuttgart.de/~jt049/webprojekt.storeit/uploads/files/";
    $filename= $row['bild'];
    $filepath=$directory.$filename;
    ?>
    <input class="profilbild" type="image" <img src='<?="$filepath"?>' width="33px" height="auto">

    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Hallo, <!--Anzeigen des jeweiligen Nutzernamens, der angemeldet ist-->
            <?php require ("connection.php");
            $sqls = "SELECT firstname FROM webprojekt WHERE userid=$userid";
            foreach ($db->query($sqls) as $rows) {
                echo $rows['firstname']; } ?>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="settings.php">Einstellungen</a>
            <a class="dropdown-item" href="logout.php">Abmelden</a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><div></div>
                        <a class="nav-link active" href=index.php>
                            <span data-feather="home"></span>
                            Alle Dateien <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href=my_files.php>
                            <span data-feather="user"></span>
                            Meine Uploads
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href=files_for_me.php>
                            <span data-feather="users"></span>
                            Für mich freigegeben
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href=trash.php>
                            <span data-feather="trash-2"></span>
                            Papierkorb
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Für mich freigegeben</h1>
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

            <!--Dateien aus upload/files/ Ordner auslesen und anzeigen-->
            <ul>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <?php
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th> Dateiname </th>";
                        echo "<th></th>";
                        echo "<th></th>";
                        echo "<th> freigegeben von</th>";
                        echo "<th> Dateigröße</th>";
                        echo "</thead>";
                        require ("connection.php");
                        include ("header.php");
                        $sql1 = "SELECT * FROM teilen WHERE userid=$userid";
                        $query1 = $db ->prepare($sql1);
                        $query1 ->execute();
                            ?>
                        <?php
                        while ($tr = $query1->fetchObject()) {
                        echo "<tbody>";
                        echo "<tr>";
                        $fileid= $tr->file_id;


                        $sql5 = "SELECT * FROM dateien WHERE id=$fileid AND file_delete=0";
                        $query5 = $db ->prepare($sql5);
                        $query5 ->execute();

                        while ($tr1 = $query5->fetchObject()) {
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td>" . "$tr1->name" . "</td>";
                        $owner= $tr1->user_id;
                        ?>

                        <!--Dateidownload-->
                        <td>
                            <form action="download.php?filename=<?= "$tr1->name" ?>&userid=<?= "$tr->userid" ?>" method="post">
                                <button class="btn btn-primary btn-sm" type="submit">
                                    <i class="fas fa-cloud-download-alt"></i>
                                </button>
                            </form>
                        </td>
                        <!-- Datei löschen-->
                        <td>
                            <form action="delete_to_trash.php?filename=<?="$tr1->name" ?>" method="post">
                                <button class="btn btn-primary btn-sm" type="submit">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>

                                <?php
                                $sql7 = "SELECT firstname, surname FROM webprojekt WHERE userid=$owner";
                                $query7 = $db->prepare($sql7);
                                $query7->execute();
                                while ($tr2 = $query7->fetchObject()) {
                                    echo "<td>" . "$tr2->firstname" . " " . "$tr2->surname" . "</td>";
                                    ?>

                                <?php
                                $sql6 = "SELECT size FROM dateien WHERE id=$fileid";
                                $query6 = $db ->prepare($sql6);
                                $query6 ->execute();
                                while ($tr6 = $query6->fetchObject()) {
                                    echo "<td>" . "$tr6->size" . "Bytes". "</td>";
                                    echo "</tr>";
                                }
                            }
                            }
                        } ?>
                    </table>
                </div>
                <?php
                ?>
            </ul>
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

<!-- Bootstrap Modals -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
