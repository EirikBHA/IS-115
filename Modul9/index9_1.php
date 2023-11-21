<?php
// Definere mappe som denne mappen
$mappe = "./";

// Variabel for å åpne mappen
$peker = opendir($mappe);

// Lage tabell
echo '<table border ="1">
         <tr>
         <th>Filnavn</th>
         <th>Filtype</th>
         <th>FilStørrelse</th>
         <th>Sist endret</th>
         <th>Lesbar</th>
         <th>Skrivbar</th>
         <th>Kjørbar</th> 
         </tr>';

// While-løkke for å hente ut filene, deres info og legge det i tabellen
while ($fil = readdir($peker)){

    echo "<tr>";
    echo "<td> <a href=\"" . $mappe . $fil . "\">" . $fil . "</a></td>";
    echo "<td>" . filetype($mappe . $fil) . "</td>";
    echo "<td>" . filesize($mappe . $fil) . "</td>";
    echo "<td>" . date("d.m.Y \k\l, H:i", filemtime($mappe . $fil)) . "</td>";
    echo "<td>" . (is_readable($mappe . $fil) ? 'Ja' :  'Nei') . "</td>";
    echo "<td>" . (is_writable($mappe . $fil) ? 'Ja' :  'Nei') . "</td>";
    echo "<td>" . (is_executable($mappe . $fil) ? 'Ja' :  'Nei') . "</td>";
    echo "</tr>";
}

echo '<a href="../modul9/index.php">Tilbake til startside</a>';