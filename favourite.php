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
            <a class="dropdown-item" href=""></a>
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
                <h1 class="h2">Favoriten</h1>
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
                        echo "<th> erstellt von</th>";
                        echo "<th> Dateigröße</th>";
                        echo "</thead>";
                        require ("connection.php");
                       $sql1 = "SELECT name, size FROM dateien WHERE user_id=$userid";
                         $query1 = $db ->prepare($sql1);
                         $query1 ->execute();
                         while ($tr = $query1->fetchObject()){
                             echo "<tbody>";
                             echo "<tr>";
                             echo "<td>" . "$tr->name". "</td>";
                             echo "<td>" . "<button class='btn btn-primary btn-sm'  title='Datei speichern'>
                                                            <form action='download.php'>
                                                                <i class='fas fa-cloud-download-alt'></i>
                                                            </form>
                                                     </button>" . "
                                                     
                                                     <button class='btn btn-primary btn-sm'  title='Datei teilen' data-toggle='modal' data-target='#myShareModal'>
                                                            <i class='fa fa-share-alt'></i>
                                                     </button>" . "
                                                        <div class='modal fade' id='myShareModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                                <div class='modal-dialog'>
                                                                    <div class='modal-content'>
                                                                        <div class='modal-header'>
                                                                            <button type='button' class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                                                                            <h2><i class=\"fa fa-envelope\"></i> Datei teilen:</h2>
                                                                        </div>
                                                                        <div class=\"modal-body\">
                                                                            <!--<p><a title=\"Facebook\" href=\"\"><span class=\"fa-stack fa-lg\"><i class=\"fa fa-square-o fa-stack-2x\"></i><i class=\"fa fa-facebook fa-stack-1x\"></i></span></a> <a title=\"Twitter\" href=\"\"><span class=\"fa-stack fa-lg\"><i class=\"fa fa-square-o fa-stack-2x\"></i><i class=\"fa fa-twitter fa-stack-1x\"></i></span></a> <a title=\"Google+\" href=\"\"><span class=\"fa-stack fa-lg\"><i class=\"fa fa-square-o fa-stack-2x\"></i><i class=\"fa fa-google-plus fa-stack-1x\"></i></span></a> <a title=\"Linkedin\" href=\"\"><span class=\"fa-stack fa-lg\"><i class=\"fa fa-square-o fa-stack-2x\"></i><i class=\"fa fa-linkedin fa-stack-1x\"></i></span></a> <a title=\"Reddit\" href=\"\"><span class=\"fa-stack fa-lg\"><i class=\"fa fa-square-o fa-stack-2x\"></i><i class=\"fa fa-reddit fa-stack-1x\"></i></span></a> <a title=\"WordPress\" href=\"\"><span class=\"fa-stack fa-lg\"><i class=\"fa fa-square-o fa-stack-2x\"></i><i class=\"fa fa-wordpress fa-stack-1x\"></i></span></a> <a title=\"Digg\" href=\"\"><span class=\"fa-stack fa-lg\"><i class=\"fa fa-square-o fa-stack-2x\"></i><i class=\"fa fa-digg fa-stack-1x\"></i></span></a>  <a title=\"Stumbleupon\" href=\"\"><span class=\"fa-stack fa-lg\"><i class=\"fa fa-square-o fa-stack-2x\"></i><i class=\"fa fa-stumbleupon fa-stack-1x\"></i></span></a><a title=\"E-mail\" href=\"\"><span class=\"fa-stack fa-lg\"><i class=\"fa fa-square-o fa-stack-2x\"></i><i class=\"fa fa-envelope fa-stack-1x\"></i></span></a>  <a title=\"Print\" href=\"\"><span class=\"fa-stack fa-lg\"><i class=\"fa fa-square-o fa-stack-2x\"></i><i class=\"fa fa-print fa-stack-1x\"></i></span></a></p>-->
                                                                            <br>
                                                                            <p>Mit anderen registrierten Nutzern teilen:</p>
                                                
                                                                            <form action=\"share.php\" method=\"post\">
                                                                                <div class=\"input-group\">
                                                                                    <input type=\"email\" name=\"emailUser\" class=\"form-control\" placeholder=\"E-Mail Addresse\">
                                                                                </div>
                                                                                <br />
                                                                                <button type=\"submit\" value=\"sub\" name=\"sub\" class=\"btn btn-primary\"><i class=\"fa fa-share\"></i> Teilen</button>
                                                
                                                                                <!--------------------------   Nicht registrierte Benutzer ----------------->
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                <p>Mit nicht-registrierten Personen teilen:</p>
                                                                                <div class=\"input-group\">
                                                                                    <input type=\"email\" name=\"email-noUser\" class=\"form-control\" placeholder=\"E-Mail-Adresse\">
                                                                                </div>
                                                                                <br />
                                                                                <button type=\"submit\" value=\"sub\" name=\"sub\" class=\"btn btn-primary\"><i class=\"fa fa-share\"></i> Teilen</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                     <button class='btn btn-primary btn-sm'  title='Datei löschen' data-toggle='modal' data-target='#myDeleteModal'>
                                                            <i class='fas fa-trash-alt'></i>
                                                     </button>" . "
                                                     <div id=\"myDeleteModal\" class=\"modal fade\">
                                                        <div class=\"modal-dialog modal-confirm\">
                                                            <div class=\"modal-content\">
                                                                <div class=\"modal-header\">
                                                                    <div class=\"icon-box\">
                                                                        <i class=\"fas fa-trash-alt\"></i>
                                                                    </div>
                                                                    <h4 class=\"modal-title\">Bist Du sicher?</h4>
                                                                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                                                                </div>
                                                                <div class=\"modal-body\">
                                                                    <p>Willst Du die Datei wirklich <b>unwiderruflich</b> löschen?</p>
                                                                </div>
                                                                <div class=\"modal-footer\">
                                                                    <button type=\"button\" class=\"btn btn-info\" data-dismiss=\"modal\">Abbrechen</button>
                                                                    <button type=\"button\" class=\"btn btn-danger\">Löschen</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                           </td>";


                             $sql2 = "SELECT firstname, surname FROM webprojekt WHERE userid=$userid";
                             $query2 = $db ->prepare($sql2);
                             $query2 ->execute();
                             while ($tr2 = $query2->fetchObject()){
                                 echo "<td>" . "$tr2->firstname"." ". "$tr2->surname"."</td>";
                                 echo "<td>" . "$tr->size". "Byte". "</td>";
                                 echo "</tr>";
                             }
                        } ?>
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

