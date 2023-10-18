<?php

/**
 * Funksjon for å kryptere en gitt string fra skjema
 * @param $text
 * @return string
 */
function cipher($text) {

    //Definere den krypterte teksten som tom, skal fylles med bruker-input
    $cryptText = "";
    //Gjøre slik at teksten blir gjort til store bokstaver
    //Litt enklere når bokstavene har samme format
    $text = strtoupper($text);

    //Loop for å gå gjennom hver bokstav i teksten
    for ($i = 0; $i < strlen($text); $i++) {

        //Setter bokstavene i array
        $char = $text[$i];

        //Sjekker om teksten er bokstaver
        if (ctype_alpha($char)) {
            //Dersom de er bokstaver gjøres den første byten av stringen om til en ASCII-verdi
            $asciiValue = ord($char);

            /*
             * $cryptValue krypterer beskjeden fra brukeren
             * Vi tar først å subtraherer fra 65. ASCII store bokstraver har verdier fra 65-90. Dermed blir A=0, B=1 osv.
             * Deretter legger 2 til for å skifte posisjonene til bokstavene 2 fram(Dette er caesar chiffrering)
             * Så tas modulo av resultatet. Det er 26 bokstaver i det engelske alfabet, så hvis bokstaver skiftes forbi Z går det tilbake til A igjen
             * Til slutt legges 65 til igjen da vi må ha de skiftede bokstavene tilbake til stor bokstav verdi igjen
             */
            $cryptValue = (($asciiValue - 65 + 2) % 26) + 65;

            //Konverterer ASCII-verdien tilbake til en bokstav of legger den til i den krypterte teksten
            $cryptText .= chr($cryptValue);

        } else {

            //Dersom karakteren ikke er en bokstav får den være som den eR
            $cryptText .= $char;
        }
    }

    //Returnerer den krypterte teksten
    return $cryptText;
}

/**
 * Funksjon for dekryptere beskjeden
 * Tar den tidligere funksjon og skifter den to bokstaver bak for å dekryptere
 * @param $text
 * @return string
 */
function decipher($text) {

    //Definere den krypterte teksten som tom, skal fylles med bruker-input
    $decryptText = "";
    //Gjøre slik at teksten blir gjort til store bokstaver
    //Litt enklere når bokstavene har samme format
    $text = strtoupper($text);

    //Loop for å gå gjennom hver bokstav i teksten
    for ($i = 0; $i < strlen($text); $i++) {

        //Setter bokstavene i array
        $char = $text[$i];

        //Sjekker om teksten er bokstaver
        if (ctype_alpha($char)) {
            //Dersom de er bokstaver gjøres den første byten av stringen om til en ASCII-verdi
            $asciiValue = ord($char);

            //dekrypterer stringen i henhold til caesar chiffrering
            //Samme prinsipp som $cryptValue, men man må legge til 26 igjen for å sikre at int-verdien er positivt
            $decryptValue = (($asciiValue - 65 -2 + 26) % 26) + 65;

            //Konverterer ASCII-verdien tilbake til en bokstav of legger den til i den dekrypterte teksten
            $decryptText .= chr($decryptValue);

        } else {

            //Dersom karakteren ikke er en bokstav får den være som den eR
            $decryptText .= $char;
        }
    }

    //Returnerer den dekrypterte teksten
    return $decryptText;
}

//Sjekker om skjema har blitt sendt inn
if (isset($_POST['submit'])) {
    //Definere variabler som skjemasvar
    $text = $_POST['text'];
    $cryptDecrypt = $_POST['cryptDecrypt'];

    //Sjekker hvilken funksjon brukeren har valgt
    if ($cryptDecrypt == 'crypt') {
        $cryptText = cipher($text);
        echo "Kryptert tekst: $cryptText";
    } elseif ($cryptDecrypt == 'decrypt') {
        $decryptText = decipher($text);
        echo "Dekryptert tekst: $decryptText";
    }
}
?>

<h2>Krypter og dekrypter en beskjed!</h2>

<form method="post">

    <label for="text">Beskjed:</label><br>
    <input type="text" name="text" required><br>

    <label for="cryptDecrypt">Krypter eller dekrypter:</label><br>
    <select name="cryptDecrypt" required>
        <option value="crypt">Krypter</option>
        <option value="decrypt">Dekrypter</option>
    </select><br>

    <input type="submit" name="submit" value="Send inn">
</form>

<?php echo '<br><a href="../modul5/index.php">Tilbake til startside</a>'; ?>
