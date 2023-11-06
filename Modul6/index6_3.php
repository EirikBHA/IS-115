<?php

/**
 * Klasse for bruker
 */
class Bruker
{
    public string $fornavn;
    public string $etternavn;
    protected string $brukernavn;
    private $fodselsdato;
    protected $registreringsdato;
    protected static array $slett_brukere = array();


    function __construct($fornavn, $etternavn, $registreringsdato) {
        $this->fornavn = $fornavn;
        $this->etternavn = $etternavn;
        $this->randBruker();
        //$this->fodselsdato = $fodselsdato;
        $this->registreringsdato = date("Y-m-d");

    }

    function getFornavn() {
        return $this->fornavn;
    }

    function getEtternavn() {
        return $this->etternavn;
    }

    function getRegDato() {
        return $this->registreringsdato;
    }

    function getBrukernavn() {
        return $this->brukernavn;
    }

    //I prosjektet kunne en slik funksjon vært nyttig å hatt for søknader eller stillinger som blir slettet
    //Ikke for brukerne men for utviklere som skal ha info om all data som går gjennom systemet
    //Dersom brukere vil gjenopprettet slettede søknader eller stillinger så kan en slik funksjon ha all infoen de trenger
    function __destruct() {
        //referer til klassen med self og legger til slettede brukere i $slettbrukere
        self::$slett_brukere[] = $this->brukernavn;
    }

    /**
     * Funksjon for å lage et tilfeldig brukernavn innenfor de tegnene som er gitt i $char
     * Tar ikke æøå
     * @param $lengde
     * @return void
     */
    function randBruker($lengde = 8) {
        //Definerer hvilke tegn som skal brukes
        $char = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        //Definerer tomt brukernavn som skal bli fylt av tegn
        $brukernavn= "";

        //for-løkke som tar tegnene definert og stokker de om slik til et 8 tegn langt brukernavn, passer også på at den ikke går utenfor indeksen med -1
        //Tar deretter og legger de til i $brukernavn
        for ($i = 0; $i < $lengde; $i++) {
            $randTegn = $char[rand(0, strlen($char) -1)];
            $brukernavn .= $randTegn;
        }

        $this->brukernavn = $brukernavn;
    }

    public function getSlettedeBrukere() {
        return self::$slett_brukere;
    }
}

class Student extends Bruker {
    function __construct($fornavn, $etternavn, $registreringsdato)
    {
        parent::__construct($fornavn, $etternavn, $registreringsdato);
    }

}

$std1 = new Student("Eirik", "Eiriksen", "2023-09-21");
$std2 = new Student("Henrik", "Henriksen", "2022-08-22");

echo "Studentene i denne oppgaven heter: " . $std1->getFornavn() . " ". $std1->getEtternavn() . " og " . $std2->getFornavn() . " " . $std2->getEtternavn() .
    " <br>De ble registrert: " . $std1->getRegDato() . " " . $std2->getRegDato() . " Deres brukernavn er: " . $std1->getBrukernavn() . " og " . $std2->getBrukernavn();

//sletter objektene
$std1->__destruct();
$std2->__destruct();

//I prosjektet kunne en slik funksjon vært nyttig å hatt for søknader eller stillinger som blir slettet
//Ikke for brukerne men for utviklere som skal ha info om all data som går gjennom systemet
//Dersom brukere vil gjenopprettet slettede søknader eller stillinger så kan en slik funksjon ha den infoen de trenger
echo "<br>Slettede brukernavn: ";
print_r($std1->getSlettedeBrukere());

echo '<br><a href="../modul6/index.php">Tilbake til startside</a>';

