<?php
// henter klassen Bruker
include 'oppg6_1.php'; 

// Underklasse som arver fra Bruker
class Student extends Bruker
{
    public string $studieprogram;


    // Overstyrer en metode fra Bruker
    public function rolle(): string
    {
        return "Student ved {$this->studieprogram}";
    }

    // Egen metode for Student
    public function leverOppgave(string $oppgavenavn): string
    {
        return "{$this->fulltNavn()} har levert oppgaven «{$oppgavenavn}».";
    }
}

// Eksempel på bruk
$student1 = new Student("Oda", "Opheim", "oda.opheim", "2003-01-01", "2023-01-01", "It og Informasjonssystemer");

// Test
echo $student1->fulltNavn() . " – Rolle: " . $student1->rolle() . "<br>";
echo $student1->leverOppgave("PHP-Modul6") . "<br>";
echo "Alder: " . $student1->alder() . " år.";
?>

