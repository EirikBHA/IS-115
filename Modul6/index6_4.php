<?php

//Definere tom variabel som skal brukes senere
$emailerr = "";

/**
 * Klasse for å validere mail
 */
class ValidateEmail {
    //Definere variabel
    public $mail;

    /**
     * Konstruktor funksjon for klassen
     * Gir variabelen verdien til email fra objektet som blir opprettet
     * @param $mail
     */
    function __construct($mail) {
        $this->mail = $mail;
    }

    /**
     * Funksjon for å validere mails fra formen
     * !== false gjør at den returnerer false dersom mailen ikke er riktig formatert
     * @return bool
     */
    public function ValidEmail() {

        return filter_var($this->mail, FILTER_VALIDATE_EMAIL) !== false;

    }

}

//Sjekker om form har blitt sendt
//Bruker funksjonen validEmail() for å validere mailen som blir sendt
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $validator = new ValidateEmail($email);
    if ($validator->ValidEmail()) {
        $emailerr = "Mailen er validert!";
    } else {
        $emailerr = "Mailen er ikke godkjent, prøv på nytt";
    }
}
?>

<h2>Skriv inn din mail!</h2>
<form action="index6_4.php" method="post">
    <label for="email">Email</label>
    <input type="text" name="email">
    <span class="error"><?php echo $emailerr;?></span>
    <br><br>
    <input type="submit" value="submit">
</form>
<br>

<?php
echo '<br><a href="../modul6/index.php">Tilbake til startside</a>';
?>
