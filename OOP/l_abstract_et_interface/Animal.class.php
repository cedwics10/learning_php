<?php
abstract class Animal
{
    public string $nom;
    public int $age;

    public function __construct($nom, $age)
    {
        $this->nom = $nom;
        $this->age = $age;
    }

    abstract public function makesound();
    abstract public function __toString();
}
