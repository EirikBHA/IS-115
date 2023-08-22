<?php

/*
Her definerer jeg variablene name og age. Dette gjør jeg ved å skrive et dollar-tegn og dermed ønsket navn på variabel.
PHP sjekker hva jeg definerer som ved å sjekke hvordan verdien skrives etter =-tegnet.
Dermed trenger jeg ikke å definere akkurat hvilken datatype variabelen skal være.
*/

$name = "Eirik";
$age = 21;

?>

<style>
    table, th, tr, td {
        border: 2px solid black;
        border-collapse: collapse;
    }
</style>

Navn og alder i tabellformat
<table>
    <tr>
        <th>Navn</th>
        <th>Alder</th>
    </tr>
    <tr>
        <td><?=$name?></td>
        <td><?=$age?></td>
    </tr>
</table>

<br>

Navn og alder i punktliste format
<ul>
    <li><?=$name?></li>
    <li><?=$age?></li>
</ul>

<br>

Navn og alder i nummerert liste format
<ol>
    <li><?=$name?></li>
    <li><?=$age?></li>
</ol>

<br>

Navn og alder i en paragraf
<p>Mitt navn er <?=$name?> og jeg er <?=$age?> år gammel</p>

<br>

<?php
echo'<a href="../modul1/Index.php">Tilbake til startside</a>';
?>
