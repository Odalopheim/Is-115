<?php

// Definerer en klasse for brukere
class Bruker
{
    public function __construct(
        public string $fornavn,
        public string $etternavn,
        public string $brukernavn,
        public string $fødselsdato,
        public string $registreringsdato
    ) {}

    // Returnerer fullt navn
    public function fulltNavn(): string
    {
        return "$this->fornavn $this->etternavn";
    }
    
    // Returnerer brukerens rolle
    public function rolle(): string
    {
        return "Standard bruker";
    }

    // Beregner alder basert på fødselsdato og dagens dato
    public function alder(): int
    {
        return (new DateTime())->diff(new DateTime($this->fødselsdato))->y;
    }
} 

// Underklasse som arver fra Bruker
class Student extends Bruker
{
    public string $studieprogram;

    // Rett konstruktør: sender alle parametre videre til Bruker
    public function __construct(
        string $fornavn,
        string $etternavn,
        string $brukernavn,
        string $fødselsdato,
        string $registreringsdato,
        string $studieprogram
    ) {
        parent::__construct($fornavn, $etternavn, $brukernavn, $fødselsdato, $registreringsdato);
        $this->studieprogram = $studieprogram;
    }

    // Overstyrer en metode fra Bruker
    public function rolle(): string
    {
        return "Student ved {$this->studieprogram}.";
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
