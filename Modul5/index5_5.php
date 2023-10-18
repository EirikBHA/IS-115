<?php
// Initialisere variabler og sette standardverdier
$celsius = "";
$fahrenheit = "";
$temperatur = "";

// Sjekk om skjemaet er sendt inn
if (isset($_POST['submit'])) {
    $konverterFra = $_POST['convert'];
    $temperatur = $_POST['temperature'];

    if ($konverterFra == 'celsFahr') {
        // Konverter fra Celsius til Fahrenheit
        $celsius = $temperatur;
        $fahrenheit = ($celsius * 9/5) + 32;
    } elseif ($konverterFra == 'fahrCels') {
        // Konverter fra Fahrenheit til Celsius
        $fahrenheit = $temperatur;
        $celsius = ($fahrenheit - 32) * 5/9;
    }
}
?>

<h2>Konverter mellom Celsius og Fahrenheit</h2>
<form method="post" action="">
    <label for="convert">Konverter fra:</label>
    <select name="convert" id="convert" required>
        <option value="celsFahr">Celsius til Fahrenheit</option>
        <option value="fahrCels">Fahrenheit til Celsius</option>
    </select>
    <br>
    <label for="temperature">Temperatur:</label>
    <input type="text" name="temperature" value="<?php echo $temperatur; ?>" required>
    <br>
    <input type="submit" name="submit" value="Konverter">
</form>

<?php
// Vis resultatet av konverteringen
//Skjemaet tar ikke null verdier så bra så definerer noen spesialtilfeller hvor den gir en beskjed basert på disse
if (!empty($celsius) && !empty($fahrenheit)) {
    echo "<p>$celsius °C er lik $fahrenheit °F</p>";
} elseif ($celsius == 0 || $fahrenheit == 32) {
    echo "<p>0 °C er lik 32 °F</p>";
} elseif ($fahrenheit == 0) {
    echo "<p>-17.77 °C er lik 0 °F</p>";
}
?>
