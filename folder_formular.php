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




    <!------ Include the above in your HEAD tag ---------->
    <style>
    body {
        font-family: Roboto,"Helvetica Neue",Arial,sans-serif;
    }
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 40%;
    }
.formular {
    margin: 3%;
}
    .h1 {
        margin-left: 3%;
        margin-top: 5%;
    }

    /* The Close Button */
    .close {
    color: #000000;
    float: right;
    font-size: 28px;
    font-weight: bold;
    }

    .close:hover,
    .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
    }
    .btn {
            background-color: #007bff;
            color: white;
        }
</style>
</head>
<body>
    <!-- Trigger/Open The Modal -->
    <button id="myBtn">Ordner erstellen</button>
    <!-- The Modal -->
    <div id="myM" class="modal">
    <!-- Modal content -->
        <div class="modal-content">
            <span class="h1">Erstelle einen Ordner</span><span class="close">&times;</span>
            <div class="formular">
                <form action="folder.php" method="post">
                <div class="input-group">
                    <input type="text" name="ordnername" class="form-control" placeholder="Benenne deinen Ordner">
                </div>
                    <br/>
                <button type="submit" value="sub" name="sub" class="btn btn-primary">
                    <i class="fas fa-folder"></i> Erstellen
                </button>
            </div>
        </div>
    </div>
    <script>
       var modal = document.getElementById('myM');

       var btn = document.getElementById("myBtn");

       var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    };

                                           span.onclick = function() {
        modal.style.display = "none";
    };

    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }
    </script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
