<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Linus Braunschweig">
    <link rel="icon" href="../../../../favicon.ico">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-------- Bootstrap Stylesheets ------------->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <!------ Include the above in your HEAD tag ---------->
    <style>
        body {
            font-family: "Helvetica Light",Helvetica,Arial,sans-serif; }
        .modal-body {
            padding-left: 25px;
            padding-bottom: 30px;
        }
        .modal-header {
            padding-left: 25px;
        }
        .modal-confirm {
            color: #636363;
            width: 400px;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }

        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }

        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }

        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }

        .modal-confirm .modal-body {
            color: #999;
        }

        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px 25px;
        }

        .modal-confirm .modal-footer a {
            color: #999;
        }

        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f44336;
        }

        .modal-confirm .icon-box i {
            color: #f44336;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }

        .modal-confirm .btn {
            color: #fff;
            border-radius: 4px;
            background: #007bff;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            border-radius: 3px;
            margin: 0 5px;
            outline: none !important;
        }

        .modal-confirm .btn-info {
            background: #c1c1c1;
        }

        .modal-confirm .btn-info:hover, .modal-confirm .btn-info:focus {
            background: #a8a8a8;
        }

        .modal-confirm .btn-danger {
            background: #f44336;
        }

        .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
            background: #f44336;
        }

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }

        #myShareModal {
            margin-left: 1em;
            margin-right: 1em;
        }
    </style>
</head>

<body>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">
        <div class="row">
            <?php
           /* session_start();
            include "connection.php";
            $userid = $_SESSION ['userid'];

            $statement= $db->prepare("SELECT name FROM dateien");
            $statement->execute();
            //print_r ($statement->fetchAll());
            foreach ($statement->fetchAll() as $value) {

            }


            // Ordnername
            $ordner = "/home/jt049/public_html/webprojekt.storeit/uploads/files/"; //auch komplette Pfade möglich ($ordner = "download/files";)
            $alledateien = scandir($ordner);
            foreach ($alledateien as $datei) {

            // Zusammentragen der Dateiinfo
            $dateiinfo = pathinfo($ordner."/".$datei); }
            if ($datei != "." && $datei != ".."  && $datei != "_notes") {
           */
           ?>

            <a href="download.php<?php echo "?filename=". $dateiinfo['basename']?>" class="btn btn-sm btn-primary"><form action="download.php<?php echo "?filename=". $dateiinfo['basename']?>"><span class="glyphicon glyphicon-cloud-download"></span></form></a>


        <!----------------- TEILEN ----------------->
            <button class="btn btn-primary btn-sm"  title="Datei teilen" data-toggle="modal" data-target="#myShareModal">
                <i class="fa fa-share-alt"></i>
            </button>
            <div class="modal fade" id="myShareModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h2><i class="fa fa-envelope"></i> Datei teilen:</h2>
                        </div>
                        <div class="modal-body">
                            <!--<p><a title="Facebook" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x"></i></span></a> <a title="Twitter" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x"></i></span></a> <a title="Google+" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x"></i></span></a> <a title="Linkedin" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x"></i></span></a> <a title="Reddit" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-reddit fa-stack-1x"></i></span></a> <a title="WordPress" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-wordpress fa-stack-1x"></i></span></a> <a title="Digg" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-digg fa-stack-1x"></i></span></a>  <a title="Stumbleupon" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-stumbleupon fa-stack-1x"></i></span></a><a title="E-mail" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-envelope fa-stack-1x"></i></span></a>  <a title="Print" href=""><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-print fa-stack-1x"></i></span></a></p>-->
                            <br>
                            <p>Mit anderen registrierten Nutzern teilen:</p>

                            <form action="share.php" method="post">
                                <div class="input-group">
                                    <input type="email" name="emailUser" class="form-control" placeholder="E-Mail Addresse">
                                </div>
                                <br />
                                <button type="submit" value="sub" name="sub" class="btn btn-primary"><i class="fa fa-share"></i> Teilen</button>

                                <!--------------------------   Nicht registrierte Benutzer ----------------->
                                <br>
                                <br>
                                <br>
                                <p>Mit nicht-registrierten Personen teilen:</p>
                                <div class="input-group">
                                    <input type="email" name="email-noUser" class="form-control" placeholder="E-Mail-Adresse">
                                </div>
                                <br />
                                <button type="submit" value="sub" name="sub" class="btn btn-primary"><i class="fa fa-share"></i> Teilen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-------- Löschen -------->
            <button class="btn btn-primary btn-sm"  title="Datei löschen" data-toggle="modal" data-target="#myDeleteModal">
                <i class="fas fa-trash-alt"></i>
            </button>
            <div id="myDeleteModal" class="modal fade">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="icon-box">
                                <i class="fas fa-trash-alt"></i>
                            </div>
                            <h4 class="modal-title">Bist Du sicher?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Willst Du die Datei wirklich <b>unwiderruflich</b> löschen?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Abbrechen</button>
                            <button type="button" class="btn btn-danger">Löschen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>