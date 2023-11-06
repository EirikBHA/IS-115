<?php

/**
 * Klasse for bruker
 */
class Bruker
{
    public string $fornavn;
    public string $etternavn;
    public string $brukernavn;
    public datetime $fødselsdato;
    public datetime $registreringsdato;

    /**
     * Funksjon for hvor fornavn og etternavn fra et objekt blir lagt sammen
     * @return void
     */
    function fulltNavn()
    {

        echo "$this->fornavn" . " $this->etternavn ";

    }

    /**
     * Funksjon som viser når en bruker ble "registrert"
     * Gir format for datetime strengen som skal skrives
     * @return void
     */
    function registrertBruker()
    {
        $registreringsDatoStreng = $this->registreringsdato->format('Y-m-d H:i:s');
        echo "Brukeren " . $this->brukernavn . " ble registrert " . $registreringsDatoStreng;
    }

}

$b1 = new Bruker();
$b1->fornavn = "Eirik";
$b1->etternavn = "Eiriksen";
$b1->brukernavn = "EirikBHA";
$b1->registreringsdato = new DateTime("2023-09-21 21:30:00");


$b1->fulltNavn();


$b1->registrertBruker();


echo '<br><a href="../modul6/index.php">Tilbake til startside</a>';