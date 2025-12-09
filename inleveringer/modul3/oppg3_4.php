<?php 
$temperatur = 5;

switch ($temperatur) 
{
    case ($temperatur >= 20):
        echo "anbefalte klær: T-skjorte og shorts";
        break;
    case ($temperatur >= 15):
        echo "anbefalte klær: Genser og bukse";
        break;
    case ($temperatur >= 5):
        echo "anbefalte klær: Jakke og bukse";
        break;

    case ($temperatur >= 0):
        echo "anbefalte klær: Vinterjakke og lue";
        break;
    default:
        echo "Ukjent temperatur";
        break;  
}





?>

