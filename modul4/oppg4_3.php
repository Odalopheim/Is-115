<?php
    // Start med en brukerprofil
    $bruker = [
        'navn' => 'Ola Nordmann',
        'epost' => 'ola@nordmann.no',
        'telefon' => '12345678'
    ];

    $feil = [];
    $oppdatert = false;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Hent og sikre input
        $ny_navn = htmlspecialchars($_POST['navn'] ?? '');
        $ny_epost = htmlspecialchars($_POST['epost'] ?? '');
        $ny_telefon = htmlspecialchars($_POST['telefon'] ?? '');

        // Validering
        if (empty($ny_navn)) $feil[] = "Navn mangler.";
        if (empty($ny_epost) || !filter_var($ny_epost, FILTER_VALIDATE_EMAIL)) $feil[] = "Ugyldig e-post.";
        if (empty($ny_telefon) || !preg_match('/^\d{8}$/', $ny_telefon)) $feil[] = "Telefonnummer må være 8 sifre.";

        // Sjekk om noe er endret
        if (empty($feil)) {
            if ($ny_navn !== $bruker['navn'] || $ny_epost !== $bruker['epost'] || $ny_telefon !== $bruker['telefon']) {
                $bruker['navn'] = $ny_navn;
                $bruker['epost'] = $ny_epost;
                $bruker['telefon'] = $ny_telefon;
                $oppdatert = true;
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <body>
        <h2>Rediger brukerprofil</h2>

        <?php
        if (!empty($feil)) {
            echo "<strong>Feil:</strong><br>";
            foreach ($feil as $f) echo "- $f<br>";
        } elseif ($oppdatert) {
            echo "<strong>Brukerprofilen er oppdatert!</strong><br>";
        }
        ?>

        <form method="post">
            Navn: <input type="text" name="navn" value="<?= htmlspecialchars($bruker['navn']) ?>"><br>
            E-post: <input type="email" name="epost" value="<?= htmlspecialchars($bruker['epost']) ?>"><br>
            Telefon: <input type="tel" name="telefon" value="<?= htmlspecialchars($bruker['telefon']) ?>"><br>
            <input type="submit" value="Oppdater">
        </form>
    </body>
</html>