<?php
session_start();
$base = defined('BASE_URL') ? BASE_URL : '/php/PHP-Prosjekt/public';

// Hvis allerede logget inn, send til dashboard
if (!empty($_SESSION['user_id'])) {
  header('Location: ' . $base . '/daschbord.php');
  exit;
}

// Hent og tøm eventuell feil
$error = $_SESSION['auth_error'] ?? '';
unset($_SESSION['auth_error']);
?>
<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Logg inn</title>

</head>
<body>
  <div class="auth-box">
    <h1>Logg inn</h1>
    <?php if ($error): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post" action="<?= htmlspecialchars($base) ?>/auth.php?action=login">
      <label>E-post<br><input type="email" name="email" required></label>
      <label>Passord<br><input type="password" name="password" required></label>
      <button type="submit">Logg inn</button>
    </form>
    <p>Ny bruker? <a href="<?= htmlspecialchars($base) ?>/register.php">Registrer deg</a></p>
  </div>
</body>
</html>