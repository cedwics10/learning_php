<?php

class Livre extends Document
{
    protected string $auteur;
    protected int $nbPages;

    public function __construct(string $noEnreg, string $titre, string $auteur, int $nbPages)
    {
        parent::__construct($noEnreg, $titre);

        $this->auteur = $auteur;
        $this->nbPages = $nbPages;
    }

    public function __toString()
    {
        $typeDoc = strtolower(get_class($this));
        return parent::__toString() .
            '- Ce ' .  $typeDoc . ' a pour auteur : ' . $this->auteur . "\n";
        '- Ce ' .  $typeDoc . ' fait ' . $this->nbPages . ' pages.' . "\n";
    }

    public function getNiveau()
    {
    }
}
