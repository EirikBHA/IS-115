<?php

//Definere variabel lagres med verdi 0 siden den skal øke i for-løkken vår
$sum = 0;

//For-løkken som tar i som er 0, dersom i er mindre enn eller lik 9 så iterer løkken
for ($i= 0; $i <= 9; $i++){


    //printer ut tallene
    print $i . "<br>";

    //Gjør at sleep()-funksjonen fungerer og gir pause i tellingen
    ob_implicit_flush(true);
    ob_flush();
    sleep(1);

    //Legger til de tallene vi har telt til summen av tall
    $sum += $i;


}

//sleep(2);

//Printer ut beskjed og summen etter at det har blitt telt
echo "Ferdig med å telle! Summen av tallene ble: " , $sum;

echo '<br><a href="../modul3/index.php">Tilbake til startside</a>';

