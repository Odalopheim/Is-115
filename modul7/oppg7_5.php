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


?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Oppgave 7_ 5</title>
    </head>
    <body>
        <h1> Database tabell</h1>

        <?php
            try {
                // Opprett databaseforbindelse
                $pdo = Database::connect();

                //Henter alle radene fra tabbelen users 4 som viser brukerens preferanser etter preferanse
                $sql = "SELECT u.fnavn,u.enavn,
                GROUP_CONCAT(p.description SEPARATOR ', ') AS preferanser FROM user4 u
                    JOIN 
                        user_preference up ON u.user_id = up.user_id
                    JOIN 
                        preference p ON up.preference_id = p.preference_id
                    GROUP BY 
                        u.user_id, u.fnavn, u.enavn
                    ORDER BY 
                        p.preference_id;
";
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

