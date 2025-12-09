<?php
$sum = 0;
for ($i = 0; $i <= 9; $i++) {
    echo $i . "<br>";
    $sum += $i;
}
 echo "Ferdig å telle summen av tallene er " . $sum . "<br>";
?>