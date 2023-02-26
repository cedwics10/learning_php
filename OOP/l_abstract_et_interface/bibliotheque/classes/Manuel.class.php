<?php
interface Scolaire
{
    const NIVEAUX = ['CP', 'CE1', 'CE2', 'CM1', 'CM2', 'Collège', 'Lycée', 'Supérieur', 'Autre'];
}

class Manuel extends Livre implements Scolaire
{
    private string $niveauSco;

    public function __construct(string $noEnreg, string $titre, string $auteur, int $nbPages, string $niveauSco)
    {
        parent::__construct($noEnreg, $titre, $auteur, $nbPages);
        $this->setNiveauSco($niveauSco);
    }

    public function getNiveau(): float
    {
        return $this->nbPages * 1.5;
    }

    public function getNiveauSco(): string
    {
        return $this->niveauSco;
    }

    private function setNiveauSco(string $niveauSco): void
    {
        $niveauSco = strtoupper($niveauSco);
        if (!in_array($niveauSco, self::NIVEAUX)) {
            echo 'Erreur : le niveau choisi n\'existe pas dans la liste' . PHP_EOL;
            $this->niveauSco = 'Autre';
        }
        $this->niveauSco = $niveauSco;
    }

    public function __toString()
    {
        return parent::__toString() . PHP_EOL
            . 'Le manuel est de niveau scolaire : ' . $this->niveauSco;
    }
}
