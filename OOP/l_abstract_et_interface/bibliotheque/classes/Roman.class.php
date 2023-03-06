<?php
class Roman extends Livre
{
    protected const RECOMPENSES = ['GONCOURT', 'MEDICIS', 'INTERALLIE', 'RENAUDOT', 'FEMINA', null];
    protected string $prixLitt;

    public function __construct(string $noEnreg, string $titre, string $auteur, int $nbPages, string $prixLitt = '')
    {
        parent::__construct($noEnreg, $titre, $auteur, $nbPages);
        if (in_array($prixLitt, self::RECOMPENSES))
            $this->prixLitt = $prixLitt;
        else
            $this->prixLitt = '';
    }

    public function getDifficulte(): float
    {
        return $this->nbPages;
    }

    public function getNoEnreg(): string
    {
        return $this->noEnreg;
    }

    public function getNbPages(): int
    {
        return $this->nbPages;
    }

    public function getPrixLitt(): string
    {
        return $this->prixLitt;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getNiveau(): float
    {
        return $this->nbPages * 1.5;
    }
}
