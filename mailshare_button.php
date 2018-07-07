<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Linus Braunschweig">
    <link rel="icon" href="../../../../favicon.ico">

    <title></title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="alertBox.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">



    <style>
        .alert {
            background-color: #00b6ff;
            color: white;
            border-radius: 5px;
            display: none;
            padding:0.7em;
            width: 100%;
            min-width: 50px;
            max-width: 490px;
        }
        .btn-md {
            margin-left: 5px;
            display: inline;
        }
        .share-btn {
            display: inline-block;
            color: #ffffff;
            border: none;
            padding: 0.5em;
            width: 2.5em;
            height: 2em;
            box-shadow: 0 2px 0 0 rgba(0,0,0,0.2);
            outline: none;
            text-align: center;
        }

        .share-btn:hover {
            color: #eeeeee;
        }

        .share-btn:active {
            position: relative;
            top: 2px;
            box-shadow: none;
            color: #e2e2e2;
            outline: none;
        }
        .share-btn.email {
            background: #007bff;
            border-radius: 5px;
        }
        .form-control {
            width: 100%;
            max-width: 200px;
            min-width: 27px;
        }
        .closebtn {
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
            margin: 0;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
<a href="" class="share-btn email">
    <i class="fa fa-envelope" aria-hidden="true"></i>
</a>
<div class="alert " >
    <span class="closebtn form-inline" onclick="this.parentElement.style.display='none';">&times;</span>
    <div class="col-md-8">
        <form action="?mailshare=1" method="post" class="form-inline">
                <div>
                    <p><strong>Mit anderen teilen:</strong></p>
                    <input type="email" name="email" class="form-control" placeholder="E-Mail Addresse"  required autofocus>
                    <button class="btn btn-md btn-primary" type="submit" name="share">Teilen</button>
                </div>
            </form>
    </div>
</div>

<script>

    $(".share-btn").click(function(){
        $(this).nextUntil('.share-btn').toggle();
        event.preventDefault();
    });

    /*$('.share-btn').first().click(function() {
       $('.alert').toggle();
       event.preventDefault();// Do somehting
   });
    $(".share-btn").on('click', function(){
            $(this).find('.alert').toggle();
        event.preventDefault();
    });
   $('.share-btn').click(function(e){
        $(e.alert).toggle();
    });
    $(this).parent('.share-btn').find('.alert').stop().toggle();

    $('.share-btn').on('click', '.alert' , function(){
        $(this).toggle(); // hides only the element that was clicked with the class .the-class
    });*/
</script>
</body>
<?php
if(isset($_GET['mailshare'])) {
    $email = $_POST['email'];
    $empfaenger = "{$email}";

    /*echo $empfaenger;*/
    $absender = "SELECT email FROM webprojekt WHERE userid ='".$_SESSION["userid"]."'";
    $betreff = "Filesharing mit store.it";
    $id = $_REQUEST['id'];
    $dateiname = "SELECT name FROM dateien WHERE id ='$id'".$_SESSION["userid"]."'"; //SO NUR EVTL RICHTIG: id muss mit dateiname verknüpft sein
    $mailtext = "{$absender} hat die Datei {$dateiname} mit dir geteilt.";
    $mailtext .= "Klicke auf den Link, um sie herunterzuladen. DIRECT_DOWNLOAD LINK-URL";

    $headers = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/plain; charset=utf-8";
    $headers[] = "Von: {$absender}";
    $headers[] = "Antwort an: {$absender}";
    $headers[] = "Betreff: {$betreff}";
    $headers[] = "X-Mailer: PHP/" . phpversion();

    mail($empfaenger, $betreff, $mailtext, implode("\r\n", $headers));
}
?>