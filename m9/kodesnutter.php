<?php
$file = fopen('filer/m9.txt', 'r'); //ÅPNE EN FIL 

fclose($file);
?>


<?php
$file = "filer/m9.txt";
$file = fopen($file, 'r');
$filedata = fread($file, 300); // reads the first 300 bytes of the file
?>


<?php
//henter inhold for hver linje
$file = fopen('filer/m9.txt', 'r') or exit('ERROR: cannot open file');
while(!feof($file))
{
	echo fgets($file);
}
fclose($file);
?>



<?php
//henter inhold for hver karakter
$file = fopen('filer/m9.txt', 'r') or exit('ERROR: cannot open file');
while(!feof($file))
{
	echo fgetc($file);
}
fclose($file);
?>




<?php
//hente hele filen som en variabel 
$str = file_get_contents('filer/m9.txt') or die('ERROR: cannot find file');
echo $str;
?>




<?php
//hente hele filen som en array
$arr = file('filer/m9.txt') or die('ERROR: cannot find file');
foreach($arr as $line)
{
	echo $line;
}
?>




<?php
//hente en ekstern fil igjennom en URL som en array
$arr = file('https://www.google.com') or die('ERROR: cannot find file');
foreach($arr as $line)
{
	echo $line;
}
?>



<?php
$file = fopen('filer/m9.txt', 'w') or exit('ERROR: cannot open file');
$text = "This is the first line";
fwrite($file, $text);
fclose($file);
?>




<?php
$file = fopen('filer/m9.txt', 'w') or exit('ERROR: cannot open file');
$text = "This is the first line";
fwrite($file, $text);
fclose($file);
?>




<?php
// skrive til fil med file_put_contents
$data = "This is the first line";
file_put_contents('output.txt', $data) or die('ERROR: cannot write file');
echo "Data written to file";
?>



<?php
// filinformasjon
if(file_exists('filer/m9.txt'))
	echo "File is " . filesize('filer/m9.txt') . " bytes.";
else 
	echo "File does not exist.";
?>




<?php
// full file path
if(file_exists('filer/m9.txt'))
	echo "File path: " . realpath('filer/m9.txt');
else 
	echo "File does not exist.";
?>



<?php
// file status
if(file_exists('filer/m9.txt'))
	print_r(stat('filer/m9.txt'));
else 
	echo "File does not exist.";
?>



<?php
// file permissions
if(file_exists('filer/m9.txt'))
{
	echo "File is: ";
	
	if(is_readable('filer/m9.txt'))
		echo "readable ";
	if(is_writable('filer/m9.txt'))
		echo "writable ";
	if(is_executable('filer/m9.txt'))
		echo "executable";
} 
else 
{
	echo "File does not exist.";
}
?>





<?php 
// sjekker om filen eksisterer
if(file_exists('filer/m9.txt'))
{
	if(is_file('filer/m9.txt')) 
		echo "It is a file.";
}
else 
{
	echo "File does not exist.";
}
?>




<?php
// kopierer filer
if(file_exists('filer/m9.txt'))
{
	if(copy('filer/m9.txt', 'nye_filer/m9.txt')) 
		echo "File successfully copied.";
	else 
		echo "ERROR: File could not be copied.";
}
else 
{
	echo "File does not exist.";
}
?>


<?php
// rename directory
if(file_exists('mydir')) 
{
	if(rename('mydir', 'myotherdir'))
		echo "Directory successfully renamed.";
	else 
		echo "ERROR: Directory could not be renamed.";
} 
else
{
	echo "ERROR: Directory does not exist.";
}
?>



<?php
// delete file
if(file_exists('filer/m9.txt'))
{
	if(unlink('filer/m9.txt')) 
		echo "File successfully removed.";
	else 
		echo "ERROR: File could not be removed.";
}
else 
{
	echo "File does not exist.";
}
?>




<?php
/* Open and lock file
   Write string to file
   Unlock and close file */
$data = "This is the first line";
$file = fopen('filer/m9.txt', 'w') or die('ERROR: cannot open file');

flock($file, LOCK_EX) or die('ERROR: cannot lock file');
fwrite($file, $data) or die('ERROR: cannot write file');
flock($file, LOCK_UN) or die('ERROR: cannot unlock file');
fclose($file);

echo "Data written to file";
?>