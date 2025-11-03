<?php
    // Metadata for fil
    $mappe = "filer/";
    $filnavn = "m9.txt";

    // Ingen mappe ved det navn?
    if(!file_exists($mappe)) 
    {
        if (!mkdir($mappe, 0777, true)) 
            die("Kan ikke opprette mappe... " . $mappe);
    }
    
    // Filpeker - fileopen
    $fp = fopen($mappe . $filnavn, "w");

    // Fildata
    $tekst  = "Data ble skrevet til fil: " . date('d.m.Y k\l. H:i:s') . " \r\n";
    $tekst .= "Filnavn: " . $mappe . $filnavn;
    
    if($l = fwrite($fp, $tekst))
        echo $l . " byte ble skrevet til fil " . $filnavn . ".";
    else
        echo "En feil har oppstått.";

    fclose($fp);
?>