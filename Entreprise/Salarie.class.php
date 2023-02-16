<?php
class Salarie
{
    protected string $nom;
    protected string $id;
    protected float $salaire;


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
        return '* Le salarié ' . $this->nom . ' au numéro de matricule ' . strval($this->id) . '<br />'
            . $this->nom . ' a pour salaire : ' . strval($this->getSalaire()) . ' €<br />';
    }
}
