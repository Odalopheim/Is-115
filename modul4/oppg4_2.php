<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        function k($str) {
            return htmlspecialchars($str ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        }

        $feil = [];

        // Validering
        if (empty($_POST['fnavn'])) $feil[] = "Fornavn mangler.";
        if (empty($_POST['enavn'])) $feil[] = "Etternavn mangler.";
        if (empty($_POST['epost']) || !filter_var($_POST['epost'], FILTER_VALIDATE_EMAIL)) $feil[] = "Ugyldig e-post.";
        if (empty($_POST['tlf']) || !preg_match('/^\d{8}$/', $_POST['tlf'])) $feil[] = "Telefonnummer må være 8 sifre.";
        if (empty($_POST['fdato'])) $feil[] = "Fødselsdato mangler.";

        if (!empty($feil)) {
            echo "<strong>Feil i skjemaet:</strong><br>";
            foreach ($feil as $f) {
                echo "- " . k($f) . "<br>";
            }
        } else {
            // Lagre data i en matrise
            $bruker = [
                'Navn' => k($_POST['fnavn']) . " " . k($_POST['enavn']),
                'E-post' => k($_POST['epost']),
                'Telefon' => k($_POST['tlf']),
                'Fødselsdato' => k($_POST['fdato'])
            ];

            echo "<strong>Bruker er registrert!</strong><br><br>";
            foreach ($bruker as $key => $value) {
                echo "$key: $value<br>";
            }
        }
    }
?>

<html>
    <head>
        <title>Brukerregistrering</title>
    </head>
    <body>
        <pre>
            <form method="post" action="">
                Fornavn: <input type="text" name="fnavn" placeholder="f.eks. Ola" required><br>
                Etternavn: <input type="text" name="enavn" placeholder="Etternavn" required><br>
                E-post: <input type="email" name="epost" placeholder="E-post"><br>
                Telefon: <input type="tel" name="tlf" placeholder="Mobilnummer" value="<?php if(isset($_REQUEST['tlf'])) echo $_REQUEST['tlf']; ?>"><br>
                Fødselsdato: <input type="date" name="fdato" value="2003-01-01"><br>
                <input type="hidden" name="honeypot" value="">
                <input type="submit" name="registrer" value="Registrér">
            </form>
        </pre>
    </body>
</html>