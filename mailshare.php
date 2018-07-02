<?php
if(isset($_GET['mailshare'])) {
    $email = $_POST['email'];

    $empfaenger = "{$email}";
}
echo $empfaenger; /*
    $betreff = "Filesharing mit store.it";
    $mailtext = "{$absendername} hat die Datei {$dateiname} mit dir geteilt.";
    $mailtext .= "Klicke auf den Link, um sie herunterzuladen. DIRECT_DOWNLOAD LINK-URL";
    $absender = "{$absenderemail}";

    $headers = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/plain; charset=utf-8";
    $headers[] = "From: {$absenderemail}";
// falls Bcc benötigt wird
    $headers[] = "Bcc: Der Da <mitleser@example.com>";
    $headers[] = "Reply-To: {$absenderemail}";
    $headers[] = "Subject: {$betreff}";
    $headers[] = "X-Mailer: PHP/" . phpversion();

    mail($empfaenger, $betreff, $mailtext, implode("\r\n", $headers));
}*/
?>