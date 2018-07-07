<head>
    <link href="alertBox.css" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">
<style>
    .congrats {
        padding: 20px;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
    }
</style>
</head>
 <?php
    include ("connection.php");
    $id = $_REQUEST['id'];
    $sql = "DELETE FROM dateien WHERE id='$id'";
    if($dsn ($db, $sql)){
        ?>
        <body>
            <div class="congrats">
                <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Die Datei wurde erfolgreich gelöscht.</strong><br>
            </div>
        </body>
<?php }
    else{
        ?>
        <body>
            <div class="alert">
                <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Die Datei konnte leider nicht gelöscht werden!</strong><br>
            </div>
        </body>
<?php } ?>
