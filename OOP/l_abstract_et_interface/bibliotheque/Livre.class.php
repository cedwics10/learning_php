<?php
class Livre extends Document
{
    protected int $nbPages;
    protected string $titre;

    public function __construct(string $titre, int $nbPages)
    {
        $this->nbPages = $nbPages;
        $this->titre = $titre;
    }

    public function getNbPages(): int
    {
        return $this->nbPages;
    }


    public function getDifficulte(): float
    {
        return $this->nbPages;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }


    public function getNoEnreg(): string
    {
        return $this->noEnreg;
    }


    public function setNoEnreg(string $noEnreg)
    {
        $this->noEnreg = $noEnreg;
    }

    public function __toString()
    {
        $typeDoc = strtolower(get_class($this));
        return '- Le document actuel est un ' .  $typeDoc . ' et se nomme "' . $this->titre . '".' . PHP_EOL
            .  '- Ce ' .  $typeDoc . ' fait ' . $this->nbPages . ' pages.' . PHP_EOL;
    }
}
