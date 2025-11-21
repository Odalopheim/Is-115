<?php
session_start();
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!doctype html>
<html lang="no">
<head><meta charset="utf-8"><title>Last opp CV</title></head>
<body>
<h1>Last opp CV</h1>

<?php if ($error): ?>
<p><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<!-- Skjema for filopplasting som sender deg videre -->
<form action="upplode_handel3.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo 1024*1024; ?>">
  <input type="file" name="cv" accept="application/pdf" required>
  <button type="submit">Last opp</button>
</form>
</body>
</html>