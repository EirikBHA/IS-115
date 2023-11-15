<?php
session_start();

if (!isset($_SESSION["uid"])) {
    echo "Du må logge inn eller registrere deg";
    ob_implicit_flush(true);
    ob_flush();
    //Legger til litt JS som gjør at man får tre sek til å lese feilmeldingen.
    echo '<script>window.setTimeout(function(){window.location.href = "login.php";}, 3000);</script>';
    exit();
}

?>

<html>
<head>
    <title>Dashbord</title>
</head>
<body>

    <h1>Velkommen til dashbordet, <?php echo $_SESSION["first_name"]; ?>!</h1>
    <p>Du er en: <?php echo $_SESSION["role"]; ?></p>
    <p>Se ledige stillinger!: <a href="jobs.php">Ledige stillinger</a></p>
    <p>Se søknader(dersom du er arbeidsgiver): <a href="applications.php">Søknader</a> </p>
    <a href="logout.php">Logout</a>

</body>
</html>
