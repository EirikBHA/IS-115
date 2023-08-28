<?php

//definere variabel med strong-tag
$etternavn = '<strong>Bakkestad</strong> <?php echo "PHP kode" ?>';

/*
 * Funksjon for å fjerne HTML- og PHP-kode fra etternavnet
 * Vi får til dette ved å benytte oss av den innebygde funksjonen striptags().
 * Denne funksjonen er nyttig dersom en ikke ønsker at brukerinput skal endre nettsiden utenom det som er tiltenkt
 * I dette tilfellet er etternavnet først definert med <strong> tekst som hadde gjort etternavnet fet og litt php kode.
 * Ved å bruke striptags() fjernes disse attributten til teksten.
 */
function strip($etternavn){

    return strip_tags($etternavn);
}

//Skriver ut etternavnet og bruker funksjonen for å fjerne kodene
echo "Etternavnet " . strip($etternavn) . " har fått fjernet alt av HTML- og PHP-kode";

?>

<br>

<?php echo '<a href="../modul2/index.php">Tilbake til startside</a>';
