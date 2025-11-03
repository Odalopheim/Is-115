<?php
class Validering
{
    // Metode for å validere e-post
    public function erGyldigEpost(string $epost): bool
    {
        return filter_var($epost, FILTER_VALIDATE_EMAIL) !== false;
    }
}

// Opprett et Validering-objekt
$validator = new Validering();

// Test e-postadresser
$epost1 = "ola.nordmann@example.com";
$epost2 = "feil-epost@@example.com";

// Valider og skriv ut resultat
echo $epost1 . " er " . ($validator->erGyldigEpost($epost1) ? "gyldig" : "ikke gyldig") . "<br>";
echo $epost2 . " er " . ($validator->erGyldigEpost($epost2) ? "gyldig" : "ikke gyldig");
?>
