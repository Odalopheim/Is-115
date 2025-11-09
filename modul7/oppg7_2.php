<?php
#database kobligs klasse
class Database {
    private static $host = 'localhost';
    private static $db   = 'modul7';
    private static $user = 'root';
    private static $pass = '';
    private static $charset = 'utf8mb4';

    public static function connect() {
        $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;
        try {
            $pdo = new PDO($dsn, self::$user, self::$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die('Database connection failed.');
        }
    }
}

function k($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$feil = [];
$registrert = false;
// Håndterer skjema innsending
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['honeypot'])) {
        exit("Spam oppdaget.");
    }

    $feil = [];

    if (empty($_POST['fnavn'])) $feil[] = "Fornavn mangler.";
    if (empty($_POST['enavn'])) $feil[] = "Etternavn mangler.";
    if (empty($_POST['epost']) || !filter_var($_POST['epost'], FILTER_VALIDATE_EMAIL)) $feil[] = "Ugyldig e-post.";
    if (empty($_POST['tlf']) || !preg_match('/^\d{8}$/', $_POST['tlf'])) $feil[] = "Telefonnummer må være 8 sifre.";
    if (empty($_POST['fdato'])) $feil[] = "Fødselsdato mangler.";

    if (empty($feil)) {
        try {
            $pdo = Database::connect();
            $sql = "INSERT INTO users2 (fnavn, enavn, epost, tlf, fdato) 
                    VALUES (:fnavn, :enavn, :epost, :tlf, :fdato)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'fnavn' => $_POST['fnavn'],
                'enavn' => $_POST['enavn'],
                'epost' => $_POST['epost'],
                'tlf'   => $_POST['tlf'],
                'fdato' => $_POST['fdato']
            ]);
            $registrert = true;
        } catch (PDOException $e) {
            $feil[] = "Databasefeil: " . k($e->getMessage());
        }
    }
}


?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Brukerregistrering</title>
</head>
<body>
    <h2>Registreringsskjema</h2>

<!-- Viser at brukeren er registrert på en brukervennlig måte -->
<?php if ($registrert): ?>
    <div style="color: green; font-weight: bold;">
        Bruker er registrert!
    </div>
<?php endif; ?>
    <form method="post" action="">
        <label>Fornavn: <input type="text" name="fnavn" required></label><br><br>
        <label>Etternavn: <input type="text" name="enavn" required></label><br><br>
        <label>E-post: <input type="email" name="epost"></label><br><br>
        <label>Telefon: <input type="tel" name="tlf" value="<?= isset($_POST['tlf']) ? k($_POST['tlf']) : '' ?>"></label><br><br>
        <label>Fødselsdato: <input type="date" name="fdato" value="2003-01-01"></label><br><br>
        <input type="hidden" name="honeypot" value="">
        <input type="submit" name="registrer" value="Registrér">
    </form>
</body>
</html>
