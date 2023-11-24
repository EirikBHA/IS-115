<?php

require_once "./PHPMailer/src/PHPMailer.php";
require_once "./PHPMailer/src/Exception.php";
require_once "./PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



// Opprett en ny PHPMailer-instans
$mail = new PHPMailer(true);

// Lage litt variabler som skal brukes
$fra = "phpeksempel@gmail.com";
$til = "eirikbakke0@gmail.com";
$emne = "Nyhetsbrev fra Steinhodene høsten 2023";

try {
    // Serverinnstillinger
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'phpeksempel@gmail.com'; // SMTP-brukernavn
    $mail->Password = 'nlsm xkup kaqj tnwi'; // passord laget for å komme forbi to-faktor autentisering
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Aktiver TLS-kryptering
    $mail->Port = 587; // TCP-port for tilkobling

    // Mottakere
    $mail->setFrom($fra);
    $mail->addAddress($til);

    // Innhold
    $mail->isHTML(true); // Sett e-postformat til HTML
    $mail->Subject = $emne;
    $mail->Body = '
    <h2>Stein nyheter!</h2><br>
    <img src="https://images.freeimages.com/variants/VZ8KRrC1agcXw91iuorUFbjj/f4a36f6589a0e50e702740b15352bc00e4bfaf6f58bd4db850e167794d05993d"><br>
    <b>Høstens steinnyheter!:</b>
    <ul>
        <li><a href="#">Stein er den nye trenden innen mote!</a></li>
        <li><a href="https://no.wikipedia.org/wiki/Moai">Verdens kuleste steiner har blitt kåret!</a></li>
        <li><a href="#">Ungdommen tar i bruk stein i sitt dagligdagse språk! Betydningen av dette uttrykket er fortsatt uvisst</a></li>
    </ul>
    <footer style="background-color: aquamarine">
    <i>Et nyhetsbrev sendt ved hjelp av PHP, Steinhodene er ikke en ekte organisasjon</i><br>
    <h3>Kontaktinfo:</h3>
    <a href="#">Instagram</a><br>
    <a href="#">Facebook</a><br>
    <a href="#">X(Tidligere Twitter)</a><br>
</footer>';

    // Send e-post
    $mail->send();
    echo 'E-post sendt!';
} catch (Exception $e) {
    echo "Feil ved sending av e-post: {$mail->ErrorInfo}";
}

echo '<br><a href="../modul10/index.php">Tilbake til startside</a>';
