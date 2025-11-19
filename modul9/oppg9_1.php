<!doctype html>
<html>
<?php
$dir = __DIR__ . '/filer';

//Gjør filstørrelse lesbar
function human_filesize($bytes) {
    if (!is_numeric($bytes)) return '-';
    if ($bytes < 1024) return $bytes . ' B';
    $units = ['KB','MB','GB','TB'];
    $i = 0;
    while ($bytes >= 1024 && $i < count($units) - 1) {
        $bytes /= 1024;
        $i++;
    }
    return round($bytes, 2) . ' ' . $units[$i];
}

//Sjekker om filene er kjørbar
function is_probably_executable($path) {
    if (is_executable($path)) return true;
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    $exe_exts = ['php','exe','bat','sh'];
    return in_array($ext, $exe_exts, true);
}
?>
<!doctype html>
<html lang="no">
<head>
  <meta charset="utf-8">
  <title>Filer i mappen "filer"</title>
</head>
<body>
  <h1>Filer i mappen "filer"</h1>
  <table>
    <thead>
      <tr>
        <th>Filnavn</th>
        <th>Type</th>
        <th>Størrelse</th>
        <th>Sist endret</th>
        <th>T/R/W/X</th>
      </tr>
    </thead>
    <tbody>
<?php
if (!is_dir($dir)) {
    echo '<tr><td colspan="5">Katalogen finnes ikke: ' . htmlspecialchars($dir) . '</td></tr>';
    echo "\n</tbody>\n</table>\n</body>\n</html>";
    exit;
}

$items = scandir($dir);
if ($items === false) {
    echo '<tr><td colspan="5">Kunne ikke lese katalogen.</td></tr>';
} else {
    $list = array_values(array_diff($items, ['.', '..']));
    natcasesort($list);
    foreach ($list as $name) {
        $path = $dir . DIRECTORY_SEPARATOR . $name;
        $type = is_dir($path) ? 'directory' : (is_file($path) ? 'file' : 'other');
        $size = is_file($path) ? human_filesize(filesize($path)) : '-';
        $mtime = file_exists($path) ? date('Y-m-d H:i:s', filemtime($path)) : '-';
        $perm = (is_readable($path) ? 'R' : '-') . (is_writable($path) ? 'W' : '-') . (is_probably_executable($path) ? 'X' : '-');
        $url = 'filer/' . rawurlencode($name);

        echo '<tr>';
        echo '<td><a href="' . htmlspecialchars($url) . '">' . htmlspecialchars($name) . '</a></td>';
        echo '<td class="mono">' . htmlspecialchars($type) . '</td>';
        echo '<td class="mono">' . htmlspecialchars($size) . '</td>';
        echo '<td class="mono">' . htmlspecialchars($mtime) . '</td>';
        echo '<td class="mono">' . htmlspecialchars($perm) . '</td>';
        echo '</tr>';
    }
}
?>
    </tbody>
  </table>
</body>
</html>