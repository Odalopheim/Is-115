<?php
    class Database {

        // Databasekonfigurasjon
        private static $host = 'localhost';
        private static $db   = 'modul7';
        private static $user = 'root';
        private static $pass = '';
        private static $charset = 'utf8mb4';

        /**
         * Oppretter og returnerer en PDO-tilkobling til databasen.
         * Bruker try/catch for å håndtere eventuelle tilkoblingsfeil på en sikker måte.
         * 
         * @return PDO  Returnerer et PDO-objekt ved vellykket tilkobling.
         */
        public static function connect() {

            // Data Source Name (DSN) – spesifiserer database-driver, vert og navn
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;


            try {
                //oppretter en ny tilkoblig til databasen ved hjelp av PDO
                $pdo = new PDO($dsn, self::$user, self::$pass);

                // Setter feilhåndtering til å kaste unntak
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $pdo;
            } catch (PDOException $e) {
                // Unngå å vise detaljerte feilmeldinger til brukere av sikkerhetsårsaker
                die('Database connection failed.');

            }
        }
        
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Oppgave 7_ 1</title>
    </head>
    <body>
        <h1> Database tabell</h1>

        <?php
            try {
                // Opprett databaseforbindelse
                $pdo = Database::connect();

                //Hetter alle radene fra tabellen 'users'
                $sql = "SELECT * FROM users";
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
