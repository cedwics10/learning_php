<?php
class Chat extends Animal
{
    private string $race;

    public function __construct(string $nom, string $race)
    {
        //appel du constructeur parent
        parent::__construct($nom);
        $this->race = $race;
    }

    //surchrage de crier
    public function crier()
    {
        //appel d'une méthode de la classe parent
        parent::crier();
        echo "$this->nom miaule.";
    }

    public function ronronner()
    {
        echo "$this->nom ronronne.";
    }

    //surcharge de toString
    public function __toString(): string
    {
        return parent::__toString() . " et je suis un " .  self::class;
    }
}
