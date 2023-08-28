<?php

//sette tomme variabler slik at de kan fylles inn
$email = "";
$emailerr = "";

if (empty($_POST["email"])) {
    $emailerr = "Du må skrive inn mailen din";

    //Sjekker om mailen er riktig formatert
} else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

    $emailerr = "Skriv inn riktig email";
} else {

    echo "Takk for at du skrev inn din mail:)";

}

?>

<!-- Lager form som man kan fylle inn med eposten sin -->
<h2>Skriv inn din mail!</h2>
<form action="index2_3.php" method="post">
    <label for="email">Email</label>
    <input type="text" name="email">
    <span class="error"><?php echo $emailerr;?></span>
    <br>
    <input type="submit" value="submit">
</form>
<br>

<?php
echo '<br><a href="../modul2/index.php">Tilbake til startside</a>';
?>
