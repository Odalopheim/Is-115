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
            $sql = "INSERT INTO users3 (fnavn, enavn, epost, tlf, fdato, registrert) 
                    VALUES (:fnavn, :enavn, :epost, :tlf, :fdato, :registrert)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'fnavn' => $_POST['fnavn'],
                'enavn' => $_POST['enavn'],
                'epost' => $_POST['epost'],
                'tlf'   => $_POST['tlf'],
                'fdato' => $_POST['fdato'],
                'registrert' => date('Y-m-d H:i:s')
            ]);
            $registrert = true;
        } catch (PDOException $e) {
            $feil[] = "Databasefeil: " . k($e->getMessage());
        }
    }
}


?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Oppgave 7_ 4</title>
    </head>
    <body>
        <h1> Database tabell</h1>

        <?php
            try {
                // Opprett databaseforbindelse
                $pdo = Database::connect();

                //Henter alle radene fra tabbelen users 3 som er en måned eller nyere
                $sql = "SELECT * FROM users3 WHERE registrert >= NOW() - INTERVAL 1 MONTH";
                $stmt = $pdo->query($sql);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!$rows) {
                    echo "<p>Ingen rader funnet i tabellen.</p>";
                } else {
                    // Lag kolonneoverskrifter fra første rad
                    $headers = array_keys($rows[0]);
        
                    echo "<table>";
                    echo "<thead><tr>";
                    //htmlspecialchars for å unngå XSS angrep
                    foreach ($headers as $h) {
                        echo "<th>" . htmlspecialchars($h) . "</th>";
                    }
                    echo "</tr></thead>";
                    echo "<tbody>";
                    foreach ($rows as $row) {
                        echo "<tr>";
                        foreach ($headers as $col) {
                            echo "<td>" . htmlspecialchars((string)$row[$col]) . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                }
                
            } catch (Exception $e) {
                echo "<p>Feil ved henting av data.</p>";
            }
        ?>

    </body>
</html>

