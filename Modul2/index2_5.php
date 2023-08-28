<?php

function Passord($passordleng=8){
    //Definere variabler
    $passord = "";
    $bokst = "abcdefghijklmnopqrstuvwxyz";
    $tall = "1234567890";

    //bruker den innebygde funksjonen rand()
    $antBokst = rand(1, $passordleng-1);
    $antCapBokst = rand(1, $antBokst);
    $antTall = $passordleng - $antBokst;

    //Bruker funksjonen velgRand() som vi har definert selv for
    $passord .= velgRand($antTall, $tall);
    $passord .= strtoupper(velgRand($antCapBokst, $bokst));
    $passord .= velgRand($antBokst - $antCapBokst, $bokst);

    return str_shuffle($passord);
}

function velgRand($numb, $string){
    //definere tom variabel
    $result = "";
    for($i = 0; $i < $numb; $i++){
        $char = $string[rand(0, strlen($string)-1)];
        $result .= $char;
    }
    return $result;
}


?>

<h1>Generer et tilfeldig passord!</h1>
<?php echo Passord()?>
<br>
<button onclick="history.go(0)">Trykk meg!</button>
<br>
<a href="../modul2/index.php">Tilbake til startside</a>
