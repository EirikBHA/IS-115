<?php
//Definere variabler som brukes for å koble til DB
$servername = "localhost";
$username = "root";
$password = "";
$db = "Modul7";

//Definere variabel som kobler til DB
$conn = mysqli_connect($servername, $username, $password, $db);

//Sjekker om tilkobling har blitt opprettet og gir tilbakemelding
if (!$conn) {
    die("Kunne ikke koble til Database: " . mysqli_connect_error());
}

//Spørring for å hente ut preferanser. UNION henter ut kun unike verdier av default
//Hvis da brukere har samme preferanse hentes kun en av de
$sql = "SELECT pref1 FROM user UNION SELECT pref2 FROM user";
$result = $conn->query($sql);

//Init av array som putter brukere i grupper
$userGroups = array();

//While-loop for å hente ut preferanser og brukerne med de preferansene
while ($row = $result->fetch_assoc()) {
    //Definere variabel som skal ha preferansene
    $preference = $row['pref1'];

    //ny spørring for å hente ut brukere med preferanse
    $sql = "SELECT username, first_name, last_name FROM user WHERE pref1 = '$preference' OR pref2 = '$preference'";
    $resultUsers = $conn->query($sql);

    //array som skal lagre preferanser
    $users = array();
    //while-loop som henter ut alle brukerne og deres preferanser
    //Legger til brukere med samme preferanse i arrayen
    while ($user = $resultUsers->fetch_assoc())
    {
        $users[] = $user;
    }

    //Legger til brukere med sammen preferanse i grupper
    $userGroups[$preference] = $users;
}

// Close the database connection
$conn->close();
?>


<html>
<body>

<?php
// Løkke for å legge brukere med samme preferanse i tabell sammen
foreach ($userGroups as $preference => $users) {
    echo "<h2>Brukere med preferansen: $preference</h2>";
    echo '<table border="1">';
    echo '<tr><th>Username</th><th>First Name</th><th>Last Name</th></tr>';

    //Løkke som legger brukerne i tabellene med brukernavn, fornavn og etternavn
    foreach ($users as $user) {
        echo '<tr>';
        echo '<td>' . $user["username"] . '</td>';
        echo '<td>' . $user["first_name"] . '</td>';
        echo '<td>' . $user["last_name"] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
}
?>

</body>
</html>

<?php echo '<br><a href="../modul7/index.php">Tilbake til startside</a>'; ?>