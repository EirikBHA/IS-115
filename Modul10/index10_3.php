<?php

//map api fra https://apidocs.geoapify.com/docs/maps/static/#about
$url =
    'https://maps.geoapify.com/v1/staticmap?
style=osm-bright&
width=600&
height=400&
center=lonlat:10.255486,60.1662082&
zoom=14&
apiKey=7db6c88ee5c04c049b78de340ef460a2';

echo 'Vælkommen til den flottaste staden på jord!:<br>';
echo '<img src="' . $url . '" width="400px">';

echo '<br><a href="../modul10/index.php">Tilbake til startside</a>';


?>
</body>
</html>

