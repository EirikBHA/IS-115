<?php

$matrise = array("Appelsin" => 0, "Eple" => 3, "Banan" => 5, "Pære" => 7, "Kiwi" => 8, "Vannmelon" => 15);

print_r($matrise);

foreach ($matrise as $key)
{

    $frukt  = array_search($key, $matrise);
    echo"<br>Frukten " . $frukt . " ligger på nøkkelen " . $key . " i matrisen";

}

echo '<br><a href="../modul4/index.php">Tilbake til startside</a>';
