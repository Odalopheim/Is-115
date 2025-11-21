<?php 
$epost = "odalo@@uia.no";

//denne her kjekker kunn om @ og . er i strengen så den trenger ikke fungere alike vell 
if (strpos($epost,"@")!== FALSE && strpos($epost,".")!== FALSE) 
   { echo "er en epost<br>";} else { echo" er ikke en epost<br>";}

//mens her følger de den offesiele standaren til hvordan en email skal se ut
if (filter_var($epost, FILTER_VALIDATE_EMAIL)){
    echo"er en epost";
} else{
    echo "er ikke en epost";
}
?>