<?php
session_start();

// Sjekker om bruker er logget inn
if (!isset($_SESSION["uid"])) {
    echo "Du må logge inn eller registrere deg";
    header("Location: dashboard.php");
    exit();
}
function getJobs() {
    $conn = mysqli_connect("localhost", "root", "", "Modul8");

    if (!$conn) {
    die("Kunne ikke koble til database:" . mysqli_connect_error());
    }

    $query = "SELECT user_id, application_id, title, description FROM jobs";
    $result = $conn->query($query);

    //Dersom antall rader i $result er større enn null blir dataene lagt inn i en HTML-tabell
    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>BrukerID</th><th>SøknadsID</th><th>Stillings Tittel</th><th>Stillings beskrivelse</th></tr>';
        //While-løkke som henter ut alle dataene som en assosiativ array
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["user_id"] . '</td>';
            echo '<td>' . $row["application_id"] . '</td>';
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

<h2>Velkommen til stillingssiden <?php echo $_SESSION["first_name"]; ?>!</h2>

<?php

getJobs();

?>

<br><a href="dashboard.php">Tilbake til dashboard</a>


</body>
</html>
