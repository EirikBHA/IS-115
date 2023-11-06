<?php

/**
 * Klasse for bruker
 */
class Bruker
{
    public string $fornavn;
    public string $etternavn;
    public string $brukernavn;
    private datetime $fodselsdato;
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
        echo " Brukeren " . $this->brukernavn . " ble registrert " . $registreringsDatoStreng;
    }
}

/**
 * Underklasse av bruker
 * Arver public felt og funksjonen fra foreldre-klassen
 */
class Student extends Bruker {

    /**
     * Funksjonen som overkjører fulltNavn funksjonen i Bruker-klasse
     * @return void
     */
    function fulltNavn()
    {
        echo "$this->fornavn" . " $this->etternavn er en student";
    }
}

//Lage nytt student-objekt og gir feltene verdier
$student = new Student();
$student->fornavn = "Eirik";
$student->etternavn = "Henriksen";
$student->brukernavn = "Eirikha";
$student->registreringsdato = new DateTime("2001-09-21 22:00:00");

//Bruker den overkjørte funksjonen og funksjonen fra foreldre-klassen
$student->fulltNavn();
$student->registrertBruker();

echo '<br><a href="../modul6/index.php">Tilbake til startside</a>';

