<?php
$dir = __DIR__ . '/filer';

function human_filesize($bytes) {
    if (!is_numeric($bytes)) return '-';
    if ($bytes < 1024) return $bytes . ' B';
    $units = ['KB','MB','GB','TB'];
    $i = 0;
    while ($bytes >= 1024 && $i < count($units)-1) {
        $bytes /= 1024;
        $i++;
    }
    return round($bytes, 2) . ' ' . $units[$i-1];
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Liste filer</title>
</head>
<body>
  <table>
    <tr>
      <th>Filnavn</th>
      <th>Filtype</th>
      <th>Filstr.</th>
      <th>Sist endret</th>
      <th>tilgang</th>
    </tr>

<?php
if (!is_dir($dir)) {
    echo '<tr><td colspan="5">Katalogen finnes ikke: ' . htmlspecialchars($dir) . '</td></tr>';
    exit;
}

$dh = opendir($dir);
if ($dh === false) {
    echo '<tr><td colspan="5">Kunne ikke åpne katalogen.</td></tr>';
    exit;
}

$items = [];
while (($name = readdir($dh)) !== false) {
    if ($name === '.' || $name === '..') continue;
    $items[] = $name;
}
closedir($dh);
sort($items, SORT_NATURAL | SORT_FLAG_CASE);

foreach ($items as $name) {
    $path = $dir . '/' . $name;
    $type = is_dir($path) ? 'directory' : (is_file($path) ? 'file' : 'other');
    $size = is_file($path) ? filesize($path) : '-';
    $mtime = file_exists($path) ? date('Y-m-d H:i:s', filemtime($path)) : '-';
    $perm = (is_readable($path) ? 'R' : '-') . (is_writable($path) ? 'W' : '-') . (is_executable($path) ? 'X' : '-');
    $url = 'filer/' . rawurlencode($name); // enkel relativ lenke

    echo '<tr>';
    echo '<td><a href="' . htmlspecialchars($url) . '">' . htmlspecialchars($name) . '</a></td>';
    echo '<td class="mono">' . htmlspecialchars($type) . '</td>';
    echo '<td class="mono">' . htmlspecialchars(is_numeric($size) ? human_filesize($size) : $size) . '</td>';
    echo '<td class="mono">' . htmlspecialchars($mtime) . '</td>';
    echo '<td class="mono">' . htmlspecialchars($perm) . '</td>';
    echo '</tr>';
}
?>
  </table>
</body>
</html>