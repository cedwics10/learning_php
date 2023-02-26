<?php

class Livre extends Document
{
    // protected string $noEnreg;
    protected string $titre;

    protected string $auteur;
    protected int $nbPages;

    public function __construct(string $noEnreg, string $titre, string $auteur, int $nbPages)
    {
        $this->$noEnreg = $noEnreg;

        $this->titre = $titre;
        $this->auteur = $auteur;

        $this->nbPages = $nbPages;
    }

    public function getNbPages(): int
    {
        return $this->nbPages;
    }

    public function getNiveau(): float
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
