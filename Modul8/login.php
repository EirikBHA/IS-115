<?php
session_start();

//Sjekker om bruker logget ut og ble redirected
if (isset($_SESSION["logout"])) {
    echo $_SESSION["logout"];
    //Unset av session slik at den ikke vises ved andre besøk til siden
    unset($_SESSION["logout"]);
}

//Koble til DB
$conn = new mysqli('localhost', 'root', '', 'Modul8');

//Sjekke om tilkobling funker
if ($conn->connect_error) {
    die("Could not connect to DB: " . $conn->connect_error);
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

    $valMail = validMail($email);

    if (!$valMail || empty($email)) {

        echo "Enter a valid email address<br>";

    } elseif (isset($_POST["login"])) {
        //Henter ut brukerinfo, sjekker etter email.
        $sql = "SELECT id, email, password, first_name, last_name, role FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $valMail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                echo "Du er logget inn! Du vil bli videreført til dashbord!";

                // lagrer brukerinfo i session
                $_SESSION["uid"] = $row['id'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["first_name"] = $row['first_name'];
                $_SESSION["last_name"] = $row['last_name'];
                $_SESSION["role"] = $row['role'];

                // Redirect til dashbord
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Feil email eller passord";
            }
        } else {
            echo "Finner ikke bruker";
        }

        $stmt->close();
    }
}

$conn->close();

?>

<html>
<head>
    <title>Login side</title>
</head>
<body>
<h2>Logg inn:</h2>

<form method="post">
    <label for="email">Email:</label>
    <input type="text" id="email" name="email"><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br>

    <input type="submit" name="login" value="Logg inn"><br>

</form>
<a href="register.php">Registrer deg</a>
</body>
</html>

