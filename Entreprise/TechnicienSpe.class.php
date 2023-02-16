<?php
class TechnicienSpe extends Salarie
{
    public int $prime;

    public function __construct(string $nom, int $id, float $salaire, float $prime)
    {
        parent::__construct($nom, $id, $salaire);
        $this->prime = $prime;
    }

    public function setPrime(int $prime)
    {
        if ($prime >= 0)
            $this->prime = $prime;
    }

    public function getSalaire(): float
    {
        return parent::getSalaire() + $this->prime;
    }
}
