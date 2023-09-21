<?php

//Definere variabler og gjøre de tomme slik at de kan lagres
$navnErr = $passErr = $tlfErr = $epostErr = "";

//Sjekke om skjema har blitt sendt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["navn"])) //Sjekker at bruker skriver inn navnet sitt
    {

        $navnErr = "Du må skrive inn navnet ditt";

    } else if (empty($_POST["pass"]) || strlen($_POST["pass"] < 8)) //sjekker at bruker skriver inn passord og at det er 8 tegn langt
    {

        $passErr = "Du må skrive inn passordet ditt eller passe på at det er 8 tegn langt";

    } else if (empty($_POST["mobilnummer"]) || strlen($_POST["mobilnummer"] < 9)) //sjekker at bruker skriver inn tlf nr og at det er 9 sifra langt
    {

        $tlfErr = "Du må skrive inn mobilnummer og passe på at det er minst 9 sifre langt";

    } else if (empty($_POST["epost"]) || (!filter_var($_POST["epost"], FILTER_VALIDATE_EMAIL))) //sjekker at mail blir skrevet inn og at det holder epost-format
    {

        $epostErr = "Du må skrive inn din riktige epost";

    } else if (isset($_POST["sendInn"])) //dersom alt er i orden og bruker sender inn data så legges brukeren inn i arrayen
    {

        //Legger til formdata i array
        $formData= array(
            "navn" => $_POST["navn"],
            "pass" => $_POST["pass"],
            "mobilnummer" => $_POST["mobilnummer"],
            "epost" => $_POST["epost"]
        );

        echo "Bruker har blitt lagt til med følgende info: <br>";
        echo "Brukernavn :", $formData["navn"];
        echo "<br>";
        echo "Mobilnummer: ", $formData["mobilnummer"];
        echo "<br>";
        echo "Epostadresse: ", $formData["epost"];
        echo "<br>";
        echo "Ditt passord har blitt lagret";
    }

}


?>

<!-- Opprette form hvor bruker kan fylle inn infoen sin og legger til feilmeldinger fra php-koden -->
<form method="post" action="">

    <label for="Navn">Brukernavn</label><br>
    <input type="text" id="navn" name="navn"><br>
    <span class="error"> <?php echo $navnErr?></span><br>

    <label for="Passord">Passord</label><br>
    <input type="password" id="pass" name="pass"><br>
    <span class="error"> <?php echo $passErr ?></span><br>

    <label for="Mobilnummer">Mobilnummer</label><br>
    <input type="number" id="mobilnummer" name="mobilnummer"><br>
    <span class="error"> <?php echo $tlfErr?></span><br>

    <label for="Epost">Epost</label><br>
    <input type="text" id="epost" name="epost"><br>
    <span class="error"> <?php echo $epostErr?></span><br>


    <input type="submit" name="sendInn" value="Send inn"><br>
</form>

<?php echo '<br><a href="../modul4/index.php">Tilbake til startside</a>'; ?>







