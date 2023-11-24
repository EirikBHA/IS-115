<?php

require_once "./PHPMailer/src/PHPMailer.php";
require_once "./PHPMailer/src/Exception.php";
require_once "./PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$navnErr = $emneErr = $tlfErr = $epostErr = "";

$epost = "";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (empty($_POST["fra"] || filter_var(($_POST["fra"]), FILTER_VALIDATE_EMAIL))) //Sjekker at bruker skriver inn navnet sitt
    {

        $navnErr = "Du må skrive inn din epost adresse. Pass på at du skriver den riktig";

    } else if (empty($_POST["til"] || filter_var(($_POST["fra"]), FILTER_VALIDATE_EMAIL))) //Sjekker at bruker skriver inn eposten sin og at de skriver inn en epost
    {

        $epostErr = "Du må skrive inn hvem du ønsker å sende eposten til, pass på at den er skrevet riktig";

    } else if (empty($_POST["emne"])) //Sjekker at bruker skriver inn emne
    {

        $emneErr = "Du må skrive inn emne";

    }  else if (isset($_POST["sendInn"])) { //Sjekker ikke om bruker sender noe i meldingen sin, da det i praksis skal være mulig å sende en tom epost

        $fra = $_POST["fra"];
        $til = $_POST["til"];
        $emne = $_POST["emne"];
        $melding = $_POST["innhold"];

        // Opprett en ny PHPMailer-instans
        $mail = new PHPMailer(true);

        try {
            // Serverinnstillinger
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'phpeksempel@gmail.com'; // SMTP-brukernavn
            $mail->Password   = 'nlsm xkup kaqj tnwi'; // passord laget for å komme forbi to-faktor autentisering
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Aktiver TLS-kryptering
            $mail->Port       = 587; // TCP-port for tilkobling

            // Mottakere
            $mail->setFrom($fra);
            $mail->addAddress($til);

            // Innhold
            $mail->isHTML(true); // Sett e-postformat til HTML
            $mail->Subject = $emne;
            $mail->Body    = $melding;

            // Send e-post
            $mail->send();
            $epost = "Du har sendt følgende mail: <br>" .
                "Fra: " . $_POST["fra"] . "<br>" .
                "Til: " . $_POST["til"] . "<br>" .
                "Emne: " . $_POST["emne"] . "<br>" .
                "Innhold: " . $_POST["innhold"];
            echo 'E-post sendt!';
        } catch (Exception $e) {
            echo "Feil ved sending av e-post: {$mail->ErrorInfo}";
        }
    }
}
?>


<!-- Opprette form hvor bruker kan fylle inn meldingen sin -->
<h2>Send en mail!</h2>
<form method="post" action="">

    <label for="fra">Fra:</label><br>
    <input type="email" id="fra" name="fra"><br>
    <span class="error"> <?php echo $navnErr?></span><br>


    <label for="epost">Til:</label><br>
    <input type="email" id="til" name="til"><br>
    <span class="error"> <?php echo $epostErr?></span><br>

    <label for="emne">Emne</label><br>
    <input type="text" id="emne" name="emne"><br>
    <span class="error"> <?php echo $emneErr?></span><br>

    <label for="innhold">Innhold</label><br>
    <textarea id="innhold" id="innhold" name="innhold" rows="4" cols="50" placeholder="Skriv inn melding..."></textarea><br>


    <input type="submit" name="sendInn" value="Send inn"><br>
</form>

<?php

echo $epost;

echo '<br><a href="../modul10/index.php">Tilbake til startside</a>';
?>
