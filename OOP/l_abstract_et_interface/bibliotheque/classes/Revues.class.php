<?php
class Revue extends Document
{
    private int $mois;
    private int $annee;
    private int $nbPages;

    public function __construct(string $noEnreg, string $titre, int $nbPages, int $mois, int $annee)
    {
        $this->noEnreg = $noEnreg;
        $this->titre = $titre;

        $this->nbPages = $nbPages;

        $this->mois = $mois;
        $this->annee = $annee;
    }



    public function getAnnee(): int
    {
        return $this->annee;
    }

    public function getMois(): int
    {
        return $this->mois;
    }

    public function getNbPages(): int
    {
        return $this->nbPages;
    }

    public function getNiveau(): float
    {
        return $this->nbPages * 0.8;
    }

    public function getNoEnreg(): string
    {
        return $this->noEnreg;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setNoEnreg(string $noEnreg)
    {
        $this->noEnreg = $noEnreg;
    }

    public function __toString()
    {
        $typeDoc = strtolower(get_class($this));
        return '- Le document actuel est un ' .  $typeDoc . ' et se nomme "' . $this->titre . '".' . PHP_EOL
            .  '- Ce ' .  $typeDoc . ' fait ' . $this->nbPages . ' pages.' . PHP_EOL
            .  "Date de publication : {$this->mois}/{$this->annee}" . PHP_EOL;
    }
}
