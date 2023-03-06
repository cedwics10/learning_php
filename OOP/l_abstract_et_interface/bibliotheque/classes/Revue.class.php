<?php
class Revue extends Document
{
    protected int $mois;
    protected int $annee;
    protected int $nbPages;

    public function __construct(string $noEnreg, string $titre, int $nbPages, int $mois, int $annee)
    {
        parent::__construct($noEnreg, $titre);

        $this->nbPages = $nbPages;

        $this->mois = $mois;
        $this->annee = $annee;
    }

    public function getNiveau(): float
    {
        return $this->nbPages * 0.8;
    }

    public function __toString()
    {
        $typeDoc = strtolower(get_class($this));

        return parent::__toString() .
            '- Le document actuel est un ' .  $typeDoc . ' et se nomme "' . $this->titre . '".' . PHP_EOL
            .  '- Ce ' .  $typeDoc . ' fait ' . $this->nbPages . ' pages.' . PHP_EOL
            .  "- Date de publication : {$this->mois}/{$this->annee}" . PHP_EOL;
    }
}
