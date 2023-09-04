<?php

//Definere variabel lagres med verdi 0 siden den skal øke i for-løkken vår
$sum = 0;

//For-løkken som tar i som er 0, dersom i er mindre enn eller lik 9 så iterer løkken
for ($i= 0; $i <= 9; $i++){


    print $i . "<br>";

    flush();
    sleep(1);

    $sum += $i;
}
if ($sum = 9) {

    echo "Ferdig med å telle! Summen av tallene ble: ", $sum;

}

echo '<br><a href="../modul3/index.php">Tilbake til startside</a>';

