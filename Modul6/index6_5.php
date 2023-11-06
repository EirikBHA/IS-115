<?php


//Definere tom variabel som skal brukes senere
$message = "";

/**
 * Klasse for å validere info
 */
class Validate {
    //Definere variabel
    public $mail;
    public $passord;
    public $tlf;

    /**
     * Konstruktor funksjon for klassen
     * Gir variabelen verdien til email fra objektet som blir opprettet
     * @param $mail
     */
    function __construct($mail, $passord, $tlf) {
        $this->mail = $mail;
        $this->passord = $passord;
        $this->tlf = $tlf;
    }

    /**
     * Funksjon for å validere data fra formen
     * Sjekk av passord er litt tungvin løsning, men ville finne en løsning som jeg forsto selv
     * Hentet fra: https://www.codexworld.com/how-to/validate-password-strength-in-php/
     * Tlf validering er inspirert av kode fra: https://www.abstractapi.com/guides/php-validate-phone-number#how-to-validate-phone-number-in-php
     * Begge er endret for å oppfylle krav for denne oppgaven
     * Regex kunne nok blitt gjort på en mye bedre måte
     * @return bool
     */
    public function validateData(): string {
        //Init av array, gjør at vi kan gi flere feilmeldinger dersom bruker skriver feil i flere felt
        $errorMessages = [];

        // Sjekker at passord inneholder:
        // En stor og liten bokstav
        // ett spesialtegn
        // Lengden på passordet er 9 tegn eller mer
        if (!preg_match('@[A-Z]@', $this->passord) ||
            !preg_match('@[a-z]@', $this->passord) ||
            !preg_match('@[0-9]@', $this->passord) ||
            !preg_match('@[^\w]@', $this->passord) ||
            strlen($this->passord) < 9) {
            $errorMessages[] = "Passord må være 9 tegn langt, inneholde en stor og liten bokstav, et spesialtegn og tall.";
        }

        // Sjekker at tlf nmr inneholder tall og er 8 tegn langt
        // Input type i HTML'en sjekker at det inneholder kun tall, så  trenger ikke sjekke bokstaver her
        if (!preg_match('/^[0-9]{8}$/', $this->tlf)) {
            $errorMessages[] = "Telefonnummer må være et norsk nummer på 8 siffer.";
        }

        // Sjekker at mail er formatert riktig med innebygd funksjon
        if (!filter_var($this->mail, FILTER_VALIDATE_EMAIL)) {
            $errorMessages[] = "E-postadressen er ugyldig.";
        }

        if (empty($errorMessages)) {
            return "Alt er validert!"; // Ingen feilmelding, dataen er gyldig
        } else {
            return implode("<br>", $errorMessages); // Returner en sammenføyning av feilmeldingene
        }
    }
}

// Sjekker om form har blitt sendt
// Bruker også funksjonen validateData() for å validere info sendt i formen
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Definere variabler til data fra formen
    $email = $_POST["email"];
    $pass = $_POST["passord"];
    $tlf = $_POST["tlf"];

    // Init av Validate-objekt med parametre
    $validator = new Validate($email, $pass, $tlf);
    // Dersom validateData() returnerer en feilmelding, vis feilmelding, ellers vis suksessmelding
    $message = $validator->validateData();
}
?>

<h2>Skriv inn din mail, passord og tlf nummer!</h2>
<form action="index6_5.php" method="post">
    <label for="email">Email</label>
    <input type="text" name="email"><br>
    <label for="passord">Passord</label>
    <input type="password" name="passord"><br>
    <label for="tlf">Telefonnummer</label>
    <input type="number" name="tlf"><br>
    <br>
    <input type="submit" value="submit">
    <span class="error"><?php echo $message; ?></span><br>
</form>
<br>

<?php
echo '<a href="../modul6/index.php">Tilbake til startside</a>';
?>
