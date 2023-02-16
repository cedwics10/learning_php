<?php
class Animal
{
    protected string $nom;
    protected string $race;
    protected int $vie;
    protected int $degats;

    public function __construct(string $nom)
    {
        $this->nom = $nom;
    }

    public function manger()
    {
        echo "$this->nom mange.";
    }

    public function crier()
    {
        echo "$this->nom émet un son.";
    }

    public function __toString(): string
    {
        return nl2br("je suis " . $this->nom
            . "et je suis un " . self::class);
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getRace()
    {
        return $this->race;
    }

    public function setVie(int $vie)
    {
        if ($vie <= 100 and $vie >= 0)
            $this->vie = $vie;
        else if ($vie < 0)
            $this->vie += $vie;
    }
}
