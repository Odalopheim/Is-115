<?php
class Validering
{
    // Valider e-post
    public function validerEpost(string $epost): string
    {
        if (!filter_var($epost, FILTER_VALIDATE_EMAIL)) {
            return "E-post er ikke gyldig.";
        }
        return "E-post er gyldig.";
    }

    // Valider passord
    public function validerPassord(string $passord): string
    {
        $feil = [];
        if (strlen($passord) < 9) {
            $feil[] = "må være minst 9 tegn";
        }
        if (!preg_match('/[A-Z]/', $passord)) {
            $feil[] = "må inneholde minst én stor bokstav";
        }
        if (preg_match_all('/[0-9]/', $passord) < 2) {
            $feil[] = "må inneholde minst to tall";
        }
        //W betyr spesialtegn
        if (!preg_match('/[\W_]/', $passord)) { 
            $feil[] = "må inneholde minst ett spesialtegn";
        }

        if (!empty($feil)) {
            return "Passord er ugyldig: " . implode(", ", $feil) . ".";
        }
        return "Passord er gyldig.";
    }

    // Valider norsk mobilnummer
    public function validerMobil(string $mobil): string
    {
        if (!preg_match('/^[49]\d{7}$/', $mobil)) {
            return "Mobilnummer er ugyldig. Må være 8 sifre og starte med 4 eller 9.";
        }
        return "Mobilnummer er gyldig.";
    }
}

// Opprett validator
$validator = new Validering();

//Ugyldig data
$epostFeil = "feil@@mail.com";
$passordFeil = "pass1!";
$mobilFeil = "12345678";

// Gyldige data
$epostGyldig = "ola.nordmann@example.com";
$passordGyldig = "Pass123!@#";
$mobilGyldig = "41234567";

// Valider og skriv ut resultat
echo "E-post (feil): " . $validator->validerEpost($epostFeil) . "<br>";
echo "E-post (gyldig): " . $validator->validerEpost($epostGyldig) . "<br><br>";

echo "Passord (feil): " . $validator->validerPassord($passordFeil) . "<br>";
echo "Passord (gyldig): " . $validator->validerPassord($passordGyldig) . "<br><br>";

echo "Mobil (feil): " . $validator->validerMobil($mobilFeil) . "<br>";
echo "Mobil (gyldig): " . $validator->validerMobil($mobilGyldig) . "<br>";
?>
