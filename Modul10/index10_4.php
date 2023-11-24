<?php
// Koble til DB
$conn = new mysqli("localhost", "root", "", "Modul10");

// Sjekke tilkobling
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hashe passord som kommer inn
function HashPass($password) {

    return password_hash($password, PASSWORD_BCRYPT);

}


// Function to insert user into the database
function insertUser($conn, $password, $name) {
    $hashedPassword = HashPass($password);
    $sql = "INSERT INTO user (password, name) VALUES ('$hashedPassword', '$name')";

    if ($conn->query($sql) === TRUE) {
        echo "Bruker satt inn i DB: $name<br>";
    } else {
        echo "En feil skjedde: " . $conn->error . "<br>";
    }
}

// Handle file upload
if (isset($_FILES["csvFile"])) {
    $file = $_FILES["csvFile"];

    // Sjekke om filen er CSV
    $fileType = pathinfo($file["name"], PATHINFO_EXTENSION);
    if (strtolower($fileType) == "csv") {
        // Lagre filen midlertidlig
        $tempFilePath = $file["tmp_name"];

        // Lese fra filen
        $file = fopen($tempFilePath, "r");

        if ($file) {
            // Må skippe headeren dersom den eksisterer
            fgetcsv($file);

            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                $password = $data[0];
                $name = $data[1];

                insertUser($conn, $password, $name);
            }

            fclose($file);
            echo "Data lagret!.<br>";
        } else {
            echo "Klarte ikke å åpne filen<br>";
        }
    } else {
        echo "Last opp riktig CSV-fil.<br>";
    }
}

// Close the database connection
$conn->close();

?>


<html>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <label for="csvFile">Last opp en CSV-fil!:</label>
    <br><input type="file" name="csvFile" accept=".csv" required>
    <br>
    <input type="submit" value="Upload">

    <?php echo '<br><a href="../modul10/index.php">Tilbake til startside</a>'; ?>
</form>
</body>
</html>
