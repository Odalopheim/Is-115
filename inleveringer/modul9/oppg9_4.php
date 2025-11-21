<?php
// De tilgjenglige filen for nedlasting
$allowed_files = [
    '1' => __DIR__ . '/filer/example1.pdf',
    '2' => __DIR__ . '/filer/example2.pdf',
];

// Hvis brukeren trykker på en gitte lastingslenken så kan den bli lastet ned 
$file_id = $_GET['file_id'] ?? null;
if ($file_id && isset($allowed_files[$file_id])) {
    $file_path = $allowed_files[$file_id];
    if (file_exists($file_path)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    } else {
        exit('Filen finnes ikke.');
    }
}

?>
<!doctype html>
<html lang="no">
<head>
  <meta charset="utf-8">
  <title>Tilgjengelige PDF-filer</title>
</head>
<body>
  <h1>Tilgjengelige PDF-filer</h1>
  <table border="1" cellpadding="5">
    <thead>
      <tr>
        <th>Filnavn</th>
        <th>Last ned</th>
      </tr>
    </thead>
    <tbody>
<?php
foreach ($allowed_files as $id => $path) {
    if (file_exists($path)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars(basename($path)) . "</td>";
        echo "<td><a href=\"?file_id=$id\">Last ned</a></td>";
        echo "</tr>";
    }
}
?>
    </tbody>
  </table>
</body>
</html>