<?php

/**
 * Funksjon for å logge til fil
 * @param $hendelse
 * @return void
 */
function logger($hendelse){
    // Åpne fil og sjekke om det skjer en feil "a" gjør at man tilføyer på slutten av filen eller lager ny
    $fil = fopen("./Files/logg.txt", "a") or die("En feil skjedde");
        //Skriver til filen
        fwrite($fil, $hendelse . "\n");
        // Lukker filen
    fclose($fil);
}

//Logger tall til fil
for($i = 0; $i < 10; $i++) {
    logger($i);
}

//Henter filen, antall linjer i filen og skriver ut de siste hendelsene. Antar at filen har 10 linjer, men det vil den ha uansett siden det blir skrivet til den
$filInnhold = file("./Files/logg.txt") or die("Feil ved åpning av fil");
$antLinjer = count($filInnhold);

// for-løkke for å hente ut filinnhold
for($i = $antLinjer - 10; $i < $antLinjer; $i++) {
    echo $filInnhold[$i];
}

echo '<br><a href="../modul9/index.php">Tilbake til startside</a>';
