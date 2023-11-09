<?php
//Definere variabler som brukes for å koble til DB
$servername = "localhost";
$username = "root";
$password = "";
$db = "Modul7";

//Definere variabel som kobler til DB
$conn = mysqli_connect($servername, $username, $password, $db);

//Sjekker om tilkobling har blitt oppretter og gir tilbakemelding
if (!$conn) {
    die("Kunne ikke koble til Database: " . mysqli_connect_error());
}

//Definere variabler og gjøre de tomme slik at de kan lagres
$fNavnErr = $eNavnErr= $bNavnErr= $passErr = $tlfErr = $epostErr = "";

//Sjekke om skjema har blitt sendt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Definere variabler som hindrer at noen forsøker å skrive kode i feltene
    $username = strip_tags($_POST["bnavn"]);
    $fName = strip_tags($_POST["fnavn"]);
    $eName = strip_tags($_POST["enavn"]);
    $pass = ($_POST["pass"]); //Passord blir ikke stripped
    $email = strip_tags($_POST["epost"]);
    $pref1 = $_POST["pref1"];
    $pref2 = $_POST["pref2"];

    if (empty($username)) //sjekker at bruker skriver inn brukernavn
    {

        $bNavnErr = "Du må skrive inn et brukernavn";

    } else if (empty($fName)) //Sjekker at bruker skriver inn fornavnet sitt
    {

        $fNavnErr = "Du må skrive inn fornavnet ditt";

    } else if (empty($eName))
    {

        $eNavnErr = "Du må skrive inn etternavnet ditt?";

    } else if (empty($pass) || strlen($_POST["pass"] < 8)) //sjekker at bruker skriver inn passord og at det er 8 tegn langt
    {

        $passErr = "Du må skrive inn passordet ditt eller passe på at det er 8 tegn langt";

    } else if (empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) //sjekker at mail blir skrevet inn og at det holder epost-format
    {

        $epostErr = "Du må skrive inn din riktige epost";

    } else if (isset($_POST["sendInn"])) //dersom alt er i orden og bruker sender inn data så legges brukeren inn i DB
    {
        //Hasher passord slik at den ikke blir stående i DB som den er skrevet
        //Velger bcrypt da string som blir lagret alltid er 60 tegn langt, dersom string varierer kan svake passord være lettere å knekke
        $hashPassword = password_hash($pass, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO user (username, password, email, first_name, last_name, pref1, pref2) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $username, $hashPassword, $email, $fName, $eName, $pref1, $pref2);

        if ($stmt->execute()) {
            echo "Din data har blitt lagret i databasen!";
        } else {
            echo "En feil skjedde: " . $stmt->error;
        }

        $stmt->close();
    }

}


?>

<html>
    <body>
    <h2>Registrer din bruker og dine preferanser!</h2>
        <!-- Opprette form hvor bruker kan fylle inn infoen sin og legger til feilmeldinger fra php-koden -->
        <form method="post" action="">

            <label for="Navn">Fornavn</label><br>
            <input type="text" id="fnavn" name="fnavn"><br>
            <span class="error"> <?php echo $fNavnErr?></span><br>

            <label for="Navn">Etternavn</label><br>
            <input type="text" id="enavn" name="enavn"><br>
            <span class="error"> <?php echo $eNavnErr?></span><br>

            <label for="Navn">Brukernavn</label><br>
            <input type="text" id="bnavn" name="bnavn"><br>
            <span class="error"> <?php echo $bNavnErr?></span><br>

            <label for="Passord">Passord</label><br>
            <input type="password" id="pass" name="pass"><br>
            <span class="error"> <?php echo $passErr ?></span><br>

            <label for="Epost">Epost</label><br>
            <input type="text" id="epost" name="epost"><br>
            <span class="error"> <?php echo $epostErr?></span><br>

            <label for="Pref1">Preferanse 1</label><br>
            <select id="pref1" name="pref1">
                <option value="utvikler">Utvikler</option>
                <option value="tømrer">Tømrer</option>
                <option value="rørlegger">Rørlegger</option>
                <option value="lege">Lege</option>
                <option value="professor">Professor</option>
            </select><br>

            <label for="Pref2">Preferanse 2</label><br>
            <select id="pref2" name="pref2">
                <option value="utvikler">Utvikler</option>
                <option value="tømrer">Tømrer</option>
                <option value="rørlegger">Rørlegger</option>
                <option value="lege">Lege</option>
                <option value="professor">Professor</option>
            </select><br>


            <input type="submit" name="sendInn" value="Send inn"><br>
    </form>
    </body>
</html>
<?php echo '<br><a href="../modul7/index.php">Tilbake til startside</a>'; ?>






