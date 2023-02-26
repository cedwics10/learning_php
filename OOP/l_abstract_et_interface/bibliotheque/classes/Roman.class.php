<?php
interface Recompensable
{
    const RECOMPENSES = ['GONCOURT', 'MEDICIS', 'INTERALLIE', 'RENAUDOT', 'FEMINA', null];
}


class Roman extends Livre implements Recompensable
{
    private string $prixLitt;

    public function __construct(string $noEnreg, string $titre, string $auteur, int $nbPages, string $prixLitt = '')
    {
        parent::__construct($noEnreg, $titre, $auteur, $nbPages);
        $this->setPrixLitt($prixLitt);
    }

    public function getDifficulte(): float
    {
        return $this->nbPages;
    }

    public function getNoEnreg(): string
    {
        return $this->noEnreg;
    }

    public function getPrixLitt(): string
    {
        return $this->prixLitt;
    }

    public function setPrixLitt($prixLitt): void
    {
        if (!in_array($prixLitt, self::RECOMPENSES))
            $this->prixLitt = $prixLitt;
        else
            echo 'Erreur : ce prix n\'existe pas';
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getNbPages(): int
    {
        return $this->nbPages;
    }

    public function setNoEnreg(string $noEnreg)
    {
        $this->noEnreg = $noEnreg;
    }
}
