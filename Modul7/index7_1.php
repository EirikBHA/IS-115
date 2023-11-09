<?php
/**
 * Funksjon for å hente ut data og legge det i en HTML-tabell
 * Ikke veldig cohesive men gjør jobben
 * @return void
 */
function getData()
{
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

    //Spørring for å hente ut info fra søknader
    $query = "SELECT user_id, job_id, title, description FROM applications";
    //Definere variabel som inneholder data fra spørringen
    $result = $conn->query($query);

    //Dersom antall rader i $result er større enn null blir dataene lagt inn i en HTML-tabell
    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>BrukerID</th><th>JobbID</th><th>SøknadsTittel</th><th>SøknadsTekst</th></tr>';
        //While-løkke som henter ut alle dataene som en assosiativ array
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["user_id"] . '</td>';
            echo '<td>' . $row["job_id"] . '</td>';
            echo '<td>' . $row["title"] . '</td>';
            echo '<td>' . $row["description"] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'Ingen data å hente';
    }

    //Avslutter tilkobling
    $conn->close();
}
?>

<html>
<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
<body>

<?php

getData();

echo '<br><a href="../modul7/index.php">Tilbake til startside</a>';

?>

</body>
</html>

