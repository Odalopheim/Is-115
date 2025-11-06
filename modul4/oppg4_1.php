<?php
    $matrise = [
        0 => "Null",
        3 => "Tre",
        5 => "Fem",
        7 => "Sju",
        8 => "Åtte",
        15 => "Femten"
    ];

  
    echo "<pre>print_r:\n";
    print_r($matrise);
    echo "</pre>";

    echo "<strong>Utskrift med løkke:</strong><br>";
    foreach ($matrise as $nokkel => $verdi) 
        {
            echo "Nøkkel $nokkel har verdi: $verdi<br>";
        }
?>
