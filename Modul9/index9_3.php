<html>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <label for="brukerNr">Skriv inn ditt brukernummer</label><br>
    <input type="number" name="brukerNr" id="brukerNr" required><br>
    <label for="bilde">Velg bilde (jpg eller png, maks 2MB):</label><br>
    <input type="file" name="bilde" accept=".jpg, .jpeg, .png" required>
    <br>
    <input type="submit" value="Last opp">
</form>

<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Definere bruker som det brukernr som blir skrivet inn og at bilder skal lastes opp i Files-mappen
    $bruker = $_POST["brukerNr"];
    $uploadDir = './Files/';

    // Sjekk om filen allerede eksisterer
    $existingImage = $uploadDir . $bruker . '.jpg';
    $existingPngImage = $uploadDir . $bruker . '.png';

    // Sjekker om filen er JPG eller JPEG
    if (file_exists($existingImage)) {
        die('Det eksisterer allerede en JPG-fil med samme navn. Velg et annet brukernummer.');
    }

    // Sjekker om filen er PNG
    if (file_exists($existingPngImage)) {
        die('Det eksisterer allerede en PNG-fil med samme navn. Velg et annet brukernummer.');
    }

    //Sjekker om filen er lastet opp
    if (is_uploaded_file($_FILES['bilde']['tmp_name'])) {
        $lastOpp = true;

        // Definere variabler etter info fra filen
        $fileName = $_FILES['bilde']['name'];
        $fileSize = $_FILES['bilde']['size'];
        $fileTmp = $_FILES['bilde']['tmp_name'];

        // Sjekk om det er en filopplasting-feil
        if ($_FILES['bilde']['error'] !== UPLOAD_ERR_OK) {
            $lastOpp = false;
            die('Det oppsto en feil ved opplasting av filen.');
        }

        // Sjekk filtypen
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png');

        if (!in_array($fileType, $allowedExtensions)) {
            $lastOpp = false;
            die('Bare JPG, JPEG og PNG-filer er tillatt.');
        }

        // Sjekk filstørrelse
        $maxFileSize = 2 * 1024 * 1024; // 2 MB
        if ($fileSize > $maxFileSize) {
            $lastOpp = false;
            die('Filen er for stor. Maks tillatt størrelse er 2 MB.');
        }

        // Dersom $lastOpp er TRUE så lagres filen
        if ($lastOpp) {
            $imgNavn = $bruker;
            $imgNavn .= ($fileType == 'image/jpeg') ? '.jpg' : '.png';
            $destination = $uploadDir . $imgNavn;

            // Lagre filen i målmappen
            move_uploaded_file($fileTmp, $destination);

            echo 'Opplasting vellykket. Filen ble lagret som ' . $imgNavn;
        }
    }
    // Lagrer bilde i variabel og gir navnet til den fra brukernummeret
    $bilde = $bruker . (file_exists('./Files/' . $bruker . '.jpg') ? '.jpg' : '.png');
    echo '
    <br><br><br>
    <div>
    <h3>Ditt profilbilde!:<h3>
            <img src="Files/' . $bilde . '" width="100px">
    </div>
    ';

}

echo '<a href="../modul9/index.php">Tilbake til startside</a>'

?>
</body>
</html>




