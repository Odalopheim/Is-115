<?php


class Database {

    // Databasekonfigurasjon (bruk disse verdiene direkte)
    private static $host = 'localhost';
    private static $db   = 'modul8';
    private static $user = 'root';
    private static $pass = '';
    private static $charset = 'utf8mb4';

    /**
     * Oppretter og returnerer en PDO-tilkobling til databasen.
     *
     * @return PDO
     */
    public static function connect() {

        $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;

        try {
            $pdo = new PDO($dsn, self::$user, self::$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            // Logg feilen hvis du vil (til fil eller error_log), men vis ikke detaljer til brukeren
            error_log('DB connect error: ' . $e->getMessage());
            die('Database connection failed.');
        }
    }

}
?>