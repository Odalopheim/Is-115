<!doctype html>
<html>
    
<head>
    <meta charset="utf-8">
    <title>M9 - lese fil</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>Filnavn</th>
            <th>Filtype</th>
            <th>Filstr.</th>
        </tr>

        <?php
           //$appe = "../m1/"; // Annen mappe
            $mappe = "./"; // Samme mappe som denne fil
            $fp = opendir($mappe); // fp = filpeker eller filhåndterer (eng. file handle)

            /* Gå gjennom mappe */
            while($neste = readdir($fp)) 
            {
                echo "<tr>";
                echo "<td><a href=\"" . $mappe . $neste . "\">" . $neste . "</a></td>";
                echo "<td>" . filetype($mappe . $neste) . "</td>";
                echo "<td>" . filesize($mappe . $neste) . "</td>";
                echo "</tr>";
            }
            
            closedir($fp);
        ?>

    </table>
</body>

</html>