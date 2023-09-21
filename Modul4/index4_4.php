<?php

//Definerer variabler for å putte i array
//strtotime() gjør at man kan skrive datoer i string som kan konverteres til datoer
$dato1 = strtotime("21 September 2023");
$dato2 = strtotime("4 July 2023");
$dato3 = strtotime("3 January 2024");

//Definerer en to dimensjonal array. Ved å ha en array inni en array
$jobber = array (
    array("Stillingstittel" => "Vaskjehjelp", "Beskrivelse" => "Vi trenger hjelp til vasking, søk nå og få spenn!","Frist for søknad" => date("d-m-y", $dato1),"Sted" => "Vågsbygd"),
    array("Stillingstittel" => "Bussjåfør", "Beskrivelse" => "Ledig bussjåfør stilling i Hønefoss! Fagbrev foretrukket", "Frist for søknad" => date("d-m-y", $dato2), "Sted" => "Hønefoss"),
    array("Stillingstittel" => "IT-konsulent", "Beskrivelse" => "Stilling som IT-konsulent ledig hos oss, send github-link", "Frist for søknad" => date("d-m-y", $dato3), "Sted" => "Finnmark"),
);

//Lager tabell
echo "<table border='1'>";

//Lager titler til kolonnene i tabellene
echo "<tr><th>Stillingstittel</th><th>Beskrivelse</th><th>Frist for søknad</th><th>Sted</th></tr>";
//foreach-løkke som går gjennom hver array
foreach ( $jobber as $jobb ) {

    //legger til en rad for hver jobb
    echo "<tr>";
    //foreach-løkke som går gjennom verdiene i arrayene
    foreach ( $jobb as $key )
    {
        //Printer ut hver verdi og legger det i tabellen
        echo "<td>" . $key . "</td>";
    }
    //Lager ny rad mellom hver jobbannonse
    echo "</tr>";
}
//Slutter tabellen
echo "</table>";

echo '<br><a href="../modul4/index.php">Tilbake til startside</a>';
