<?php
session_start();

// Sjekker om bruker er logget inn
if (!isset($_SESSION["uid"])) {
    echo "Du må logge inn eller registrere deg";
    ob_implicit_flush(true);
    ob_flush();
    //bruker JS for å få feilmeldingen til å vare litt
    echo '<script>window.setTimeout(function(){window.location.href = "login.php";}, 3000);</script>';
    exit();
} elseif (!isset($_SESSION["role"]) || $_SESSION["role"] !== "arbeidsgiver") {
    echo "Du må være en arbeidsgiver";
    ob_implicit_flush(true);
    ob_flush();
    //Denne sender bruker til dashboard og ikke login
    echo '<script>window.setTimeout(function(){window.location.href = "dashboard.php";}, 3000);</script>';
    exit();
}

function getApplications() {
    $conn = mysqli_connect("localhost", "root", "", "Modul8");

    if (!$conn) {
            die("Kunne ikke koble til database:" . mysqli_connect_error());
    }

    $query = "SELECT user_id, job_id, title, description, type FROM applications";
    $result = $conn->query($query);

    //Dersom antall rader i $result er større enn null blir dataene lagt inn i en HTML-tabell
    if ($result->num_rows > 0) {
    echo '<table>';
        echo '<tr><th>BrukerID</th><th>JobID</th><th>Søknads Tittel</th><th>Søknad tekst</th><th>Jobbtittel</th></tr>';
        //While-løkke som henter ut alle dataene som en assosiativ array
        while ($row = $result->fetch_assoc()) {
        echo '<tr>';
            echo '<td>' . $row["user_id"] . '</td>';
            echo '<td>' . $row["job_id"] . '</td>';
            echo '<td>' . $row["title"] . '</td>';
            echo '<td>' . $row["description"] . '</td>';
            echo '<td>' . $row["type"] . '</td>';
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

<h2>Velkommen til Søknadssiden <?php echo $_SESSION["first_name"]; ?>!</h2>

<?php

getApplications();

?>

<br><a href="dashboard.php">Tilbake til dashboard</a>

</body>
</html>
