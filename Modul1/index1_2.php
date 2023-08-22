<?php

/*
Ved å bruke funksjonen phpinfo() vil en kunne se hvordan PHP er konfiguert i nettleseren vår.
Når funksjonen blir kalt så vil flere tabeller bli grafisk fremvist for brukeren.
Disse tabellene gir informasjon om hvordan koden vil fungere innad i nettleseren for brukere og får oss som programmerer nettsiden
Ved å sjekke display_error kan vi se at denne er On i mitt tilfelle.
Dette betyr at feilmeldingene som forekommer ved feil syntaks i koden vil bli fremvist når en prøver å gå til nettstedet for filen som det er feil i
Det er veldig viktig at denne er On under utvikling slik at jeg som koder kan oppdage feil jeg har gjort i koden og fikse det, slik at koden fungerer slik den skal.

I tabellen Apache environment finnet vi også DOCUMENT_ROOT, verdien her tilsier hvor apache miljøet og xampp er installert på PC'en. 
Det er kjekt å vite at det er installert riktig sted og vit hvor en skriver link til hvis en skal linke til en annen fil i en mappe samme sted.
Som jeg har gjort i index.php filen min.
*/

phpinfo();

echo '<a href="../modul1/Index.php">Tilbake til startside</a>';
?>