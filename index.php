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

    <title>Startseite</title>
    <link rel="icon" type="image/png" href="logo_neu.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">store.it</a>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Neu
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
            <a class="dropdown-item" href="#">
                <form action="folder.php" method="post">
                    <p> <input type="text" name="ordnername" placeholder="Benenne deinen Ordner"/> <input type="submit" value="Ordner erstellen"/>
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
    <input class="form-control form-control-dark w-10 search" type="text" placeholder="Search" aria-label="Search">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Hallo, <!--Anzeigen des jeweiligen Nutzernamens, der angemeldet ist-->
            <?php require ("connection.php");
            $sqls = "SELECT firstname FROM webprojekt WHERE userid=$userid";
            foreach ($db->query($sqls) as $rows) { echo $rows['firstname']; }
            ?>
        </button>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="settings.php">
                <!-- Anzeigen des Benutzerbilds, des eingeloggten Nutzers-->
                <?php require ("connection.php");
                $sqls1 = "SELECT bild FROM webprojekt WHERE userid=$userid";
                foreach ($db->query($sqls1) as $row) ?></a>
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
                    <li class="nav-item">
                        <a class="nav-link" href=my_files.php>
                            <span data-feather="user"></span>
                            Meine Uploads
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=files_for_me.php>
                            <span data-feather="users"></span>
                            Für mich freigegeben
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
                <h1 class="h2">Startseite</h1>
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
                        echo "<th></th>";
                        echo "<th></th>";
                        echo "<th> erstellt von</th>";
                        echo "<th> Dateigröße</th>";
                        echo "</thead>";
                        require ("connection.php");
                        include ("header.php");
                        //gibt Dateien aus, die meine Userid, weder gelöscht oder in einem Ordner sind & meine haben und in Dateien-Tabelle stehen
                        $sql1 = "SELECT * FROM dateien WHERE user_id=$userid AND file_delete=0 AND ordner_id=0";
                        $query1 = $db ->prepare($sql1);
                        $query1 ->execute();

                        //gibt Ordner aus, die vom user und nicht gelöscht sind
                        $statement=$db->prepare('SELECT * FROM ordner WHERE user_id=? AND file_delete=0'); // user id eingefügt mit der ich eingeloggt bin
                        $statement->bindParam(1, $userid);
                        $statement->execute();

                        //schafft Verlinkung in angeklickten Ordner
                        while ($ts = $statement->fetchObject()) {
                            echo "<tbody>";
                            echo "<tr>";
                            echo "<td>" ."<a href='folder_content.php?ordnerid=$ts->ordnerid'>$ts->name</a>" . "</td>";
                            ?>

                            <!-- Datei löschen-->
                       <td></td>
                            <td></td>
                            <td>
                                <form action="delete_to_trash.php?ordnerid=<?= "$ts->ordnerid" ?>" method="post">
                                    <button class="btn btn-primary btn-sm" type="submit">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>

                            <?php
                        }
                            while ($tr = $query1->fetchObject()) {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . "$tr->name" . "</td>"; //Name der Datei aus Zeile wird ausgegeben
                                ?>

                                <!--Verschieben nach-->
                                <td>
                                    <form action="verschieben.php?filename=<?="$tr->name"?>" method="post">
                                        <p><input type="text" name="ordnername" placeholder="Ordnername"/> <input type="submit" value="Verschieben"/></p>
                                    </form>
                                </td>
                                <!--Dateidownload-->
                                <td>
                                    <form action="download.php?filename=<?= "$tr->name" ?>&userid=<?= "$tr->user_id" ?>" method="post">
                                        <button class="btn btn-primary btn-sm" type="submit">
                                            <i class="fas fa-cloud-download-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                 <!-- Datei löschen-->
                                    <td><form action="delete_to_trash.php?filename=<?="$tr->name"?>" method="post">
                                        <button class="btn btn-primary btn-sm" type="submit" >
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    </td>
                                <!--Datei teilen-->
                                <td>
                                    <button class='btn btn-primary btn-sm' title='Datei teilen' data-toggle='modal'
                                            data-target='#myShareModal'>

                            <!--Verschieben nach-->
                            <td>
                                <form action="verschieben.php?filename=<?="$tr->name"?>" method="post">
                                    <p><input type="text" name="ordnername" placeholder="Ordnername"/> <input type="submit" value="Verschieben"/></p>
                                </form>
                            </td>

                            <!--Dateidownload-->
                            <td>
                                <form action="download.php?filename=<?= "$tr->name" ?>" method="post">
                                    <button class="btn btn-primary btn-sm" type="submit">
                                        <i class="fas fa-cloud-download-alt"></i>
                                    </button>
                                </form>
                            </td>

                            <!-- Datei löschen-->
                            <td>
                                <form action="delete_to_trash.php?filename=<?="$tr->name"?>" method="post">
                                    <button class="btn btn-primary btn-sm" type="submit" >
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>

                            <!--Datei teilen-->
                            <td>
                                    <button class='btn btn-primary btn-sm' title='Datei teilen' data-toggle='modal' data-target='#myShareModal'>
                                        <i class='fa fa-share-alt'></i>
                                    </button>
                                    <div class='modal fade' id='myShareModal' tabindex='-1' role='dialog'
                                         aria-labelledby='myModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <button type='button' class='close' data-dismiss='modal'
                                                            aria-hidden='true'>&times;
                                                    </button>
                                                    <h2><i class='fa fa-envelope'></i> Datei teilen:</h2>
                                                </div>
                                                <div class='modal-body'>
                                                    <br>
                                                    <p>Mit anderen registrierten Nutzern teilen:</p>
                                                    <form action="share.php?dateiname=<?= "$tr->name" ?>" method="post">
                                                        <div class='input-group'>
                                                            <input type='email' name='emailUser' class='form-control'
                                                                   placeholder='E-Mail Addresse'>
                                                        </div>
                                                        <br/>
                                                        <button type='submit' value='Teilen' name='subUser'
                                                                class='btn btn-primary'><i class='fa fa-share'></i>
                                                            Teilen
                                                        </button>
                                                        <!--------------------------   Nicht registrierte Benutzer ----------------->
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <p>Mit nicht-registrierten Personen teilen:</p>
                                                        <div class='input-group'>
                                                            <input type='email' name='email-noUser' class='form-control'
                                                                   placeholder='E-Mail-Adresse'>
                                                        </div>
                                                        <br/>
                                                        <button type='submit' value='Teilen' name='subNUser'
                                                                class='btn btn-primary'><i class='fa fa-share'></i>
                                                            Teilen
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                //gibt Vor- & Nachname des Erstellers der Datei aus
                                $sql2 = "SELECT firstname, surname FROM webprojekt WHERE userid=$userid";
                                $query2 = $db->prepare($sql2);
                                $query2->execute();
                                while ($tr2 = $query2->fetchObject()) {
                                    echo "<td>" . "$tr2->firstname" . " " . "$tr2->surname" . "</td>";
                                    echo "<td>" . "$tr->size" . "Bytes" . "</td>";

                                    echo "</tr>";
                                }
                        }
                                //zeigt mir die für mich freigegebenen Dateien an
                                $sql1 = "SELECT file_id FROM teilen WHERE userid=$userid";
                                $query1 = $db ->prepare($sql1);
                                $query1 ->execute();
                                ?>
                                <?php
                                while ($tr = $query1->fetchObject()) {
                                echo "<tbody>";
                                echo "<tr>";
                                $fileid= $tr->file_id;


                                $sql5 = "SELECT name, user_id FROM dateien WHERE id=$fileid AND file_delete=0";
                                $query5 = $db ->prepare($sql5);
                                $query5 ->execute();

                                while ($tr = $query5->fetchObject()) {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . "$tr->name" . "</td>";
                                $owner= $tr->user_id;
                                echo "<th></th>";
                                ?>

                                <!--Dateidownload-->

                            <td>
                                <form action="download.php?filename=<?= "$tr->name" ?>" method="post">
                                    <button class="btn btn-primary btn-sm" type="submit">
                                        <i class="fas fa-cloud-download-alt"></i>
                                    </button>
                                </form>
                            </td>

                            <!-- Datei löschen-->
                            <td>
                                <form action="delete_to_trash.php?filename=<?="$tr->name" ?>" method="post">
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
                            echo "<th></th>";
                            echo "<td>" . "$tr2->firstname" . " " . "$tr2->surname" . "</td>";
                            ?>

                            <?php
                            $sql6 = "SELECT size FROM dateien WHERE id=$fileid";
                            $query6 = $db ->prepare($sql6);
                            $query6 ->execute();
                            while ($tr = $query6->fetchObject()) {
                            echo "<td>" . "$tr->size" . "Bytes". "</td>";
                            echo "</tr>";}
                            }
                        }
                    }
                            ?>
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
<!-- Scripts zur Ladegeschwindigkeitsoptimierung-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<!-- Icons für Sidebar -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>

<!-- Bootstrap Modals für Pop-Ups-->
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
</html>