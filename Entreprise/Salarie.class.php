<?php
class Salarie
{
    private const DEVISE = '€';
    private string $nom;
    private string $id;
    private float $salaire;

    public function __construct($nom, $id, $salaire)
    {
        $this->nom = $nom;
        $this->id = $id;
        $this->salaire = $salaire;
    }

    public function getSalaire(): float
    {
        return $this->salaire;
    }

    public function __toString(): string
    {
        return 'Le salarié ' . $this->nom . ' au numéro de matricule ' . $this->id
            . ' a pour salaire : ' . strval($this->getSalaire()) . self::DEVISE . '<br />';
    }
}
