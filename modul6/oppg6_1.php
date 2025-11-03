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
     public function rolle(): string {
        return "Standard bruker";
    }

    // Beregner alder basert på fødselsdato og dagens dato
    public function alder(): int
    {
        return (new DateTime())->diff(new DateTime($this->fødselsdato))->y;
    }
}

// Opprette to brukere
$bruker1 = new Bruker("Ola", "Nordmann", "ola.nordmann", "1990-01-01", "2023-01-01");
$bruker2 = new Bruker("Kari", "Hansen", "kari.hansen", "1992-02-02", "2023-02-02");

// Test
echo "{$bruker1->fulltNavn()} er {$bruker1->alder()} år gammel.<br>";
echo "{$bruker2->fulltNavn()} er {$bruker2->alder()} år gammel.";
?>
