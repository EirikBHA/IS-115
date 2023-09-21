<?php

$navnErr = $emneErr = $tlfErr = $epostErr = "";

$epost = "";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (empty($_POST["navn"])) //Sjekker at bruker skriver inn navnet sitt
    {

        $navnErr = "Du må skrive inn navnet ditt";

    } else if (empty($_POST["epost"])) //Sjekker at bruker skriver inn eposten sin
    {

        $epostErr = "Du må skrive inn eposten din";

    } else if (empty($_POST["emne"])) //Sjekker at bruker skriver inn emne
    {

        $emneErr = "Du må skrive inn emne";

    }  else if (isset($_POST["sendInn"])) { //Sjekker ikke om bruker sender noe i meldingen sin, da det i praksis skal være mulig å sende en tom epost

        $epost = "Du har sendt følgende melding: <br>" .
            "Navn: " . $_POST["navn"] . "<br>" .
            "Epost-adresse: " . $_POST["epost"] . "<br>" .
            "Emne: " . $_POST["emne"] . "<br>" .
            "Innhold: " . $_POST["innhold"]; //Dersom bruker ikke skriver noe så vil placeholder melding bli sendt



    }
}
?>

<!-- Opprette form hvor bruker kan fylle inn infoen sin -->
<h2>Oppdater din info i matrisen!</h2>
<form method="post" action="">

    <label for="Navn">Navn</label><br>
    <input type="text" id="navn" name="navn"><br>
    <span class="error"> <?php echo $navnErr?></span><br>


    <label for="epost">Epost-adresse</label><br>
    <input type="email" id="epsot" name="epost"><br>
    <span class="error"> <?php echo $epostErr?></span><br>

    <label for="emne">Emne</label><br>
    <input type="text" id="emne" name="emne"><br>
    <span class="error"> <?php echo $emneErr?></span><br>

    <label for="innhold">Innhold</label><br>
    <textarea id="innhold" id="innhold" name="innhold" rows="4" cols="50">Skriv inn melding...</textarea><br>


    <input type="submit" name="sendInn" value="Send inn"><br>
</form>

<?php

echo $epost;

echo '<br><a href="../modul4/index.php">Tilbake til startside</a>';
?>


