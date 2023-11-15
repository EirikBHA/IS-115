<?php
session_start();

//koble til DB
$conn = new mysqli('localhost', 'root', '', 'Modul8');

//Gi feilmelding dersom noe er feil
if ($conn->connect_error) {
    die("Kunne ikke koble til DB: " . $conn->connect_error);
}

/**
 * Funksjon for å hashe passord. Sjekker om bruker skriver et sterkt passord
 * @param $password
 * @return false|string|null
 */
function passHash($password) {

    //Sjekker om bruker skriver et passord på 9 tegn med en stor og liten bokstav og ett spesial tegn og tall
    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[^\w]).{9,}$/', $password)) {
        echo "Pass på at passordet ditt inneholder en stor og liten bokstav og inneholder ett spesial tegn og tall";
    }

    return password_hash($password, PASSWORD_BCRYPT);

}

/**
 * Funksjon for å validere mail
 * @param $mail
 * @return mixed
 */
function validMail($mail) {
    return filter_var($mail, FILTER_VALIDATE_EMAIL);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strip_tags($_POST["email"]);
    $password = $_POST["password"];
    $fname = $_POST["fname"];
    $ename = $_POST["ename"];
    $role = $_POST["rolle"];



    $valMail = validMail($email);

    if (!$valMail || empty($email)) {

        echo "skriv inn riktig epost<br>";

    } elseif (empty($password) || strlen($password) < 9) {

        echo "Skriv inn passord på 9 tegn, med én stor og liten bokstav og ett spesialtegn og tall<br>";

    } elseif (empty($fname)) {

        echo "Skriv inn ditt fornavn<br>";

    }elseif (empty($ename)) {

        echo "Skriv inn ditt etternavn<br>";

    } elseif (isset($_POST["sendInn"])) {

        $hashPass = passHash($password);

        $sql = "INSERT INTO user (email, password, first_name, last_name, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $valMail, $hashPass, $fname, $ename, $role);

        if ($stmt->execute()) {
            echo "Bruker registrert! Du blir videreført til hovedsiden!";

            $_SESSION["uid"] = $stmt->insert_id;
            $_SESSION["email"] = $valMail;

            header("Location: dashboard.php");
            exit();
            //TODO: Legge inn redirect her
        } else {
            echo "Feil ved registrering: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();

?>

<html>
<head>
    <title>Registreringsside</title>
</head>
<body>
<h2>Registrer din bruker!</h2>

<form method="post">
    <label for="email">Email:</label>
    <input type="text" id="email" name="email"><br>

    <label for="password">Passord:</label>
    <input type="password" id="password" name="password"><br>

    <label for="fname">Fornavn:</label>
    <input type="text" id="fname" name="fname"><br>

    <label for="ename">Etternavn:</label>
    <input type="text" id="ename" name="ename"><br>

    <label for="rolle">Rolle:</label><br>
    <select id="rolle" name="rolle">
        <option value="arbeidsgiver">Arbeidsgiver</option>
        <option value="arbeidssøker">Arbeidssøker</option>
    </select><br>

    <input type="submit" name="sendInn" value="Registrer din bruker"><br>

</form>
</body>
</html>
