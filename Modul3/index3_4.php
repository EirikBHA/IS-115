<body>
<h2>Velg en kommune og se hvilket fylke den tilhører!</h2>

<!--Form med radioknapper for å ta input på hvilken kommune bruker vil sjekke -->
<form method="post" action="">
    <label for="Kristiansand">Kristiansand</label>
    <input type="radio" id="Kristiansand" name="choice" value="Kristiansand"><br>

    <label for="Lillesand">Lillesand</label>
    <input type="radio" id="Lillesand" name="choice" value="Lillesand"><br>

    <label for="Birkenes">Birkenes</label>
    <input type="radio" id="Birkenes" name="choice" value="Birkenes"><br>

    <label for="Harstad">Harstad</label>
    <input type="radio" id="Harstad" name="choice" value="Harstad"><br>

    <label for="Kvæfjord">Kvæfjord</label>
    <input type="radio" id="Kvæfjord" name="choice" value="Kvæfjord"><br>

    <label for="Tromsø">Tromsø</label>
    <input type="radio" id="Tromsø" name="choice" value="Tromsø"><br>

    <label for="Bergen">Bergen</label>
    <input type="radio" id="Bergen" name="choice" value="Bergen"><br>

    <label for="Trondheim">Trondheim</label>
    <input type="radio" id="Trondheim" name="choice" value="Trondheim"><br>

    <label for="Bodø">Bodø</label>
    <input type="radio" id="Bodø" name="choice" value="Bodø"><br>

    <label for="Alta">Alta</label>
    <input type="radio" id="Alta" name="choice" value="Alta"><br>

    <input type="submit" name="submit">
</form>
</body>

<?php

//Sjekker først om det faktisk har blitt valgt en kommune
if (empty($_POST["choice"])) {

    echo "Du må velge en kommune";

    //Dersom det blir valgt en kommune kjøres denne
} else if (isset($_POST["submit"])) {

    //init av kommune variabel. Den er den samme som det som har blitt valgt
    $kommune = $_POST["choice"];

    //Bruker match statement. Kan ta å sjekke flere variabler og mathce det med én verdi
    //Litt greiere å kode en en switch statement
    $fylke = match ($kommune) {
        "Kristiansand", "Lillesand", "Birkenes" => "Agder",
        "Harstad", "Kvæfjord", "Tromsø" => "Troms og Finnmark",
        "Bergen" => "Vestland",
        "Trondheim" => "Trønderlag",
        "Bodø" => "Nordland",
        "Alta" => "Finnmark"
    };

    echo "Kommunen " . $kommune . " befinner seg i ", $fylke;

}


echo '<br><a href="../modul3/index.php">Tilbake til startside</a>';



