<?php

class Manuel extends Livre
{
    protected const NIVEAUX = ['CP', 'CE1', 'CE2', 'CM1', 'CM2', 'Collège', 'Lycée', 'Supérieur', 'Autre'];

    private string $niveauSco;

    public function __construct(string $noEnreg, string $titre, string $auteur, int $nbPages, string $niveauSco)
    {
        parent::__construct($noEnreg, $titre, $auteur, $nbPages);
        $niveauSco = strtoupper($niveauSco);
        $this->niveauSco = $niveauSco;
        if (!in_array($niveauSco, self::NIVEAUX)) {
            echo 'Erreur : le niveau choisi n\'existe pas dans la liste' . PHP_EOL;
            $this->niveauSco = 'Autre';
        }
    }

    public function getNiveau(): float
    {
        return $this->nbPages * 1.5;
    }

    public function __toString()
    {
        return parent::__toString() . PHP_EOL
            . 'Le manuel est de niveau scolaire : ' . $this->niveauSco . "\n";
    }
}
