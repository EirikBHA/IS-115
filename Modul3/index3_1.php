<?php

//Definere tidsvariabler $bday er satt til bursdagen min og $today er dagens dato
$bday = new DateTime("2023-09-21");
$today = new DateTime();

/*
 * If-statements som sjekker bursdagen mot dagens dato
 * Dersom de er det samme skrives det at jeg har bursdag
 * Dersom Bursdagen er mer så skrives det at jeg ikke har hatt bursdag enda
 *
 */
if ($bday == $today) {

    echo "Jeg har bursdag idag!";

} else if ($bday > $today) {

    echo "Jeg har ikke hatt bursdag enda";
} else {

    echo "Jeg har hatt bursdag";

}

echo '<br><a href="../modul3/index.php">Tilbake til startside</a>';