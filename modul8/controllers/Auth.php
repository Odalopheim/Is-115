<?php
require_once __DIR__ . '/../models/User.php';

class Auth {
    public static function handleLogin() {
        session_start();
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = User::verifyCredentials($email, $password);
        if ($user) {
            // Sett session og redirect
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            // Bestem rolle: først fra user-array, så sjekk @admin-domenet, ellers hent fra DB eller default
            $role = $user['role'] ?? null;
            // matcher @admin eller @admin.* (f.eks. @admin.no)
            if ($role === null && preg_match('/@admin(\.|$)/i', $email)) {
                $role = 'admin';
            }
            if ($role === null && method_exists('User', 'getRoleById')) {
                $role = User::getRoleById($user['id']) ?? 'user';
            }
            $_SESSION['user_role'] = $role ?? 'user';

            header('Location: ../index.php');
            exit;
        } else {
            $_SESSION['auth_error'] = 'Ugyldig e-post eller passord.';
            header('Location: ../login.php');
            exit;
        }
    }

    public static function handleRegister() {
        session_start();
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Hvis du vil ta imot rolle fra skjema (register.php har select), hent den her:
        $submittedRole = $_POST['role'] ?? null;

        $ok = User::register($name, $email, $password);
        if ($ok) {
            // Etter registrering, logg inn automatisk
            $user = User::verifyCredentials($email, $password);
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            // Bestem rolle: prioriter rolle fra DB/verify, deretter skjema, så @admin-domene, ellers default
            $role = $user['role'] ?? null;
            if ($role === null && $submittedRole) {
                $role = $submittedRole;
            }
            if ($role === null && preg_match('/@admin(\.|$)/i', $email)) {
                $role = 'admin';
            }
            if ($role === null && method_exists('User', 'getRoleById')) {
                $role = User::getRoleById($user['id']) ?? 'user';
            }
            $_SESSION['user_role'] = $role ?? 'user';

            header('Location: ../index.php');
            exit;
        } else {
            $_SESSION['auth_error'] = 'Kunne ikke registrere brukeren. E-post kan allerede være i bruk.';
            header('Location: ../register.php');
            exit;
        }
    }

    public static function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../login.php');
        exit;
    }
}


// Enkel dispatcher slik at denne filen kan kalles direkte fra form action
if (php_sapi_name() !== 'cli') {
    $action = $_GET['action'] ?? '';
    if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        Auth::handleLogin();
    } elseif ($action === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        Auth::handleRegister();
    } elseif ($action === 'logout') {
        Auth::logout();
    }
}