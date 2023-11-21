<?php

// Definere filen som skal lastes ned
$fil = "./Files/Innlevering 9.pdf";

// Script for å laste ned fil. Bruker headers for å sikre at bruker ikke mottar info om filen.
if (file_exists($fil)) {
    header("Content-Description: File Transfer");
    header("Content-Type: application/octet-stream");
    header("Content-Lenght: " . filesize($fil));
    //header("Content-Transfer-Encoding: Binary");
    header('Content-Disposition: attachment; filename="' . basename($fil) .'"');
    header("Pragma: public");
    readfile($fil);
    exit;
}
?>