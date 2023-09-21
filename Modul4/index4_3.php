<?php

//Definere variabler og gjøre de tomme slik at de kan endres
$navnErr = $passErr = $tlfErr = $epostErr = "";

$formData = array(
        "navn" => "Eirik",
        "mobilnummer" => "123456789",
        "epost" => "eirik@eirik.no"
);

//Definere variabel for å gi tilbakemelding til brukeren
$meld = "";

//Sjekke om skjema har blitt sendt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["navn"])) //Sjekker at bruker skriver inn navnet sitt
    {

        $navnErr = "Du må skrive inn navnet ditt";

    }  else if (empty($_POST["mobilnummer"]) || strlen($_POST["mobilnummer"]) < 8) //sjekker at bruker skriver inn tlf nr og at det er 9 sifra langt
    {

        $tlfErr = "Du må skrive inn mobilnummer og passe på at det er minst 9 sifre langt";

    } else if (empty($_POST["epost"]) || (!filter_var($_POST["epost"], FILTER_VALIDATE_EMAIL))) //sjekker at mail blir skrevet inn og at det holder epost-format
    {

        $epostErr = "Du må skrive inn din riktige epost";

    } else if (isset($_POST["sendInn"]) || $formData["navn"] != $_POST["navn"] || $formData["mobilnummer"] != $_POST["mobilnummer"] || $formData["epost"] != $_POST["epost"]) //dersom alt er i orden og bruker sender inn data som er ny så legges brukeren inn i arrayen
    {

        //Legger til formdata i array
        $formData= array(
            "navn" => $_POST["navn"],
            "mobilnummer" => $_POST["mobilnummer"],
            "epost" => $_POST["epost"]
        );

        $meld = "Dette er din oppdaterte brukerinfo<br>
        Brukernavn: " . $formData["navn"] . "<br>
        Mobilnummer: " . $formData["mobilnummer"] . "<br>
        Epostadresse: " . $formData["epost"];


    } else {

    $meld = "Ingen endringer ble gjort"; //Dersom brukeren ikke oppdaterer info blir det ikke lagt inn og de får beskjed om  det

    }
}


?>

<!-- Opprette form hvor bruker kan fylle inn infoen sin og legger til feilmeldinger fra php-koden -->
<h2>Oppdater din info i matrisen!</h2>
<form method="post" action="">

    <label for="Navn">Brukernavn</label><br>
    <input type="text" id="navn" name="navn" value="<?php echo $formData["navn"]; ?>"><br>
    <span class="error"> <?php echo $navnErr?></span><br>


    <label for="Mobilnummer">Mobilnummer</label><br>
    <input type="number" id="mobilnummer" name="mobilnummer" value="<?php echo $formData["mobilnummer"]; ?>"><br>
    <span class="error"> <?php echo $tlfErr?></span><br>

    <label for="Epost">Epost</label><br>
    <input type="text" id="epost" name="epost" value="<?php echo $formData["epost"]; ?>"><br>
    <span class="error"> <?php echo $epostErr?></span><br>


    <input type="submit" name="sendInn" value="Send inn"><br>
</form>

<p><?php echo $meld; ?></p>

<?php echo '<br><a href="../modul4/index.php">Tilbake til startside</a>'; ?>

