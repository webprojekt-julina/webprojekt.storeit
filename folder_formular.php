<!DOCTYPE html>
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
    <!--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->


    <!------ Include the above in your HEAD tag ---------->
    <style>
        body {/* Popup box BEGIN */
        .hover_bkgr_fricc{
            background:rgba(0,0,0,.4);
            cursor:pointer;
            display:none;
            height:100%;
            position:fixed;
            text-align:center;
            top:0;
            width:100%;
            z-index:10000;
        }
        .hover_bkgr_fricc .helper{
            display:inline-block;
            height:100%;
            vertical-align:middle;
        }
        .hover_bkgr_fricc > div {
            background-color: #fff;
            box-shadow: 10px 10px 60px #555;
            display: inline-block;
            height: auto;
            max-width: 551px;
            min-height: 100px;
            vertical-align: middle;
            width: 60%;
            position: relative;
            border-radius: 8px;
            padding: 15px 5%;
        }
        .popupCloseButton {
            background-color: #fff;
            border: 3px solid #999;
            border-radius: 50px;
            cursor: pointer;
            display: inline-block;
            font-family: arial;
            font-weight: bold;
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 25px;
            line-height: 30px;
            width: 30px;
            height: 30px;
            text-align: center;
        }
        .popupCloseButton:hover {
            background-color: #ccc;
        }
        .trigger_popup_fricc {
            cursor: pointer;
            font-size: 20px;
            margin: 20px;
            display: inline-block;
            font-weight: bold;
        }
        /* Popup box BEGIN */
    </style>
</head>
<body>
    <a class="trigger_popup_fricc">Ordner erstellen</a>

    <div class="hover_bkgr_fricc">
        <span class="helper"></span>
        <div>
            <div class="popupCloseButton">X</div>
            <p>Add any HTML content<br />inside the popup box!</p>
        </div>
    </div>
   <script>
       $(window).load(function () {
    $(".trigger_popup_fricc").click(function(){
    $('.hover_bkgr_fricc').show();
    });
    $('.hover_bkgr_fricc').click(function(){
    $('.hover_bkgr_fricc').hide();
    });
    $('.popupCloseButton').click(function(){
    $('.hover_bkgr_fricc').hide();
    });
    });
   </script>
</body>
</html>
