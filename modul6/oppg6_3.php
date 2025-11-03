<?php
class Bruker
{
    public string $fornavn;
    public string $etternavn;
    protected string $brukernavn;
    protected string $registreringsdato;

    // Statisk matrise for å lagre slettede brukernavn
    public static array $slettedeBrukere = [];

    // Konstruktør
    public function __construct(string $fornavn, string $etternavn)
    {
        $this->fornavn = $fornavn;
        $this->etternavn = $etternavn;
        $this->brukernavn = $this->genererBrukernavn();
        $this->registreringsdato = date("Y-m-d H:i:s");
    }

    // Destruktør
    public function __destruct()
    {
        // Legg brukernavnet til i matrise når objektet slettes
        self::$slettedeBrukere[] = $this->brukernavn;
    }

    // Generer tilfeldig brukernavn
    protected function genererBrukernavn(): string
    {
        return strtolower(substr($this->fornavn, 0, 1) . $this->etternavn) . rand(100, 999);
    }

    // Metode for å vise info
    public function visInfo(): string
    {
        return "Navn: {$this->fornavn} {$this->etternavn}, Brukernavn: {$this->brukernavn}, Registreringsdato: {$this->registreringsdato}";
    }
}

// Underklasse Student
class Student extends Bruker
{
    public string $studieprogram;

    public function __construct(string $fornavn, string $etternavn, string $studieprogram)
    {
        parent::__construct($fornavn, $etternavn);
        $this->studieprogram = $studieprogram;
    }

    // Overstyrer visInfo for å inkludere studieprogram
    public function visInfo(): string
    {
        return parent::visInfo() . ", Studieprogram: {$this->studieprogram}";
    }
}

// Opprette to objekter
$student1 = new Student("Oda", "Opheim", "IT og Informasjonssystemer");
$student2 = new Student("Eirik", "Hansen", "Informatikk");

// Vis info for de to studentene
echo $student1->visInfo() . "<br>";
echo $student2->visInfo() . "<br>";

// Slett brukkerne
unset($student1);
unset($student2);

// Skriv ut brukernavnene til slettede brukere
echo "<br>Slettede brukernavn:<br>";
foreach (Bruker::$slettedeBrukere as $brukernavn) {
    echo $brukernavn . "<br>";
}
?>
