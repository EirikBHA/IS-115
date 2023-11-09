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

//Formatere date variabel
$date = date("Y-m-d");

//spørring som henter ut annonser som er lik eller "større" enn dagens dato
$sql = "SELECT title, description, type, deadline FROM jobs WHERE deadline >= '$date'";
$result = $conn->query($sql);
?>

<html>
    <body>
    <h2>Ledige stillinger</h2>
    <table border="1">
        <tr>
            <th>JobbTittel</th>
            <th>JobbBeskrivelse</th>
            <th>StillingsTittel</th>
            <th>Frist for søknad</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row["title"] ?></td>
            <td><?php echo $row["description"] ?></td>
            <td><?php echo $row["type"] ?></td>
            <td><?php echo $row["deadline"] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    </body>
</html>

<?php

$conn->close();

echo '<br><a href="../modul7/index.php">Tilbake til startside</a>';

?>
