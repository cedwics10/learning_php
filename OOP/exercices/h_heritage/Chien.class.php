<?php
class Chien extends Animal
{
    private string $codeCollier;
    private const VIE_MAX = 100;

    public function __construct(string $nom, string $race, string $codeCollier)
    {
        parent::__construct($nom);
        $this->race = $race;
        $this->codeCollier = $codeCollier;
        $this->vie = 100;
        $this->degats = 5;
    }

    //surchrage de crier
    public function crier()
    {
        //appel d'une méthode de la classe parent
        parent::crier();
        echo "$this->nom aboie.";
    }

    public function mord(Animal $animal)
    {
        $animal->setVie((-1) * $this->degats);
        echo "$this->nom mord le " . $animal->getRace() . " qui s'appelle " . $animal->getNom();
    }


    //surcharge de toString
    public function __toString(): string
    {
        return parent::__toString() . "<br />
        et je suis un " .  self::class;
    }
}
