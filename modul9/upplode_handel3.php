<?php
session_start();

// Sett en test-ID (i praksis fra database/login)
$user_id = 1;

if (!isset($_FILES['cv'])) {
    $_SESSION['error'] = "Ingen fil valgt.";
    header("Location: index.php"); exit;
}

$file = $_FILES['cv'];

// Sjekk feil
if ($file['error'] !== UPLOAD_ERR_OK) {
    $_SESSION['error'] = "Feil ved opplasting.";
    header("Location: index.php"); exit;
}

// Sjekk størrelse
if ($file['size'] > 1024*1024) {
    $_SESSION['error'] = "Filen er for stor (maks 1 MB).";
    header("Location: index.php"); exit;
}

// Sjekk MIME-type
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);
if ($mime !== 'application/pdf') {
    $_SESSION['error'] = "Kun PDF-filer er tillatt.";
    header("Location: index.php"); exit;
}

// Lagre i mappen "filer"
$dir = __DIR__ . '/filer';
if (!is_dir($dir)) mkdir($dir);

$dest = $dir . '/' . $user_id . '.pdf';
move_uploaded_file($file['tmp_name'], $dest);

// Vis informasjon om filen
$size = round(filesize($dest)/1024,2) . " KB";
?>
<!doctype html>
<html lang="no">
<head><meta charset="utf-8"><title>CV lastet opp</title></head>
<body>
<h1>CV lastet opp</h1>
<p><a href="filer/<?php echo $user_id; ?>.pdf" target="_blank">Vis CV</a></p>
<ul>
  <li>Filnavn: <?php echo $user_id; ?>.pdf</li>
  <li>Størrelse: <?php echo $size; ?></li>
  <li>Format: PDF</li>
  <li>Plassering: <?php echo htmlspecialchars(realpath($dest)); ?></li>
</ul>
</body>
</html>