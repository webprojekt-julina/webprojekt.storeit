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
    <link href="signin.css" rel="stylesheet">
    <link href="alertBox.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">



    <style>
        .alert {
            background-color: #00b6ff;
            color: white;
            border-radius: 5px;
            width: 35%;
            display: none;
            padding:10px;
        }
        .btn-md {
            margin: 5px;
        }
        .share-btn {
            display: inline-block;
            color: #ffffff;
            border: none;
            padding: 0.5em;
            width: 4em;
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
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
<a href="" class="share-btn email" id="email-but">
    <i class="fa fa-envelope" aria-hidden="true"></i>
</a>
<div class="alert" id="formular" >
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <div class="col-md-8">
            <form action="?mailshare=1" method="post" class="form-inline">
                <div>
                    <p><strong>Mit anderen teilen:</strong></p>
                    <input type="email" class="form-control" placeholder="E-Mail Addresse" name="email" required autofocus>
                    <button class="btn btn-md btn-primary" type="submit" name="share">Teilen</button>
                </div>
            </form>
    </div>
</div>
<script>
    $("#email-but").click(function(){
            $("#formular").toggle();
        event.preventDefault();
    });
</script>
</body>
<?php
if(isset($_GET['mailshare'])) {
    $email = $_POST['email'];
    $empfaenger = "{$email}";

    /*echo $empfaenger;*/
    $betreff = "Filesharing mit store.it";
    $mailtext = "Linus hat die Datei {$dateiname} mit dir geteilt.";
    $mailtext .= "Klicke auf den Link, um sie herunterzuladen. DIRECT_DOWNLOAD LINK-URL";
    $absender = "{lb107@hdm-stuttgart.de}";

    $headers = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/plain; charset=utf-8";
    $headers[] = "From: {lb107@hdm-stuttgart.de}";
// falls Bcc benötigt wird
    /*$headers[] = "Bcc: <mitleser@example.com>";*/
    $headers[] = "Reply-To: {lb107@hdm-stuttgart.de}";
    $headers[] = "Subject: {$betreff}";
    $headers[] = "X-Mailer: PHP/" . phpversion();

    mail($empfaenger, $betreff, $mailtext, implode("\r\n", $headers));
}
?>