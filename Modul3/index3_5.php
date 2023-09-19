<?php

//definere variabler
$brett = 64;

$antKorn = 1;

$totalVekt = 0.035;

for ($i = 1; $i <= $brett; $i++) {

    //regner ut vekt av korn. Gram til tonn er 1000000
    $vektKorn = $antKorn * $totalVekt /1000000;

    //printer ut hvilken rute man er på, antall korn ved hver rute og vekten deres
    echo "Ved rute " . $i . " så er det " . $antKorn . " korn. De veier " . $vektKorn . " tonn<br>";

    //Ganger det antallet med korn som var på forrige rute med to slik at det øker med seg selv
    //Skriver den etter setningen blir skrevet ut slik at vi starter på 1 korn på rute 1.
    $antKorn *= 2;

}

//Ganger antall korn og vekt med seg selv for å få total vekt og antall.
echo "Den totale vekten av alle hvetekornene blir: " . $antKorn * 2 . " og den totale vekten vekten i tonn blir: " , $vektKorn * 2;

echo '<br><a href="../modul3/index.php">Tilbake til startside</a>';


?>
