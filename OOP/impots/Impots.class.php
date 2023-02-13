<?php
class Impots
{
    const HOMME = "H";
    const FEMME = "F";
    const AGE_MAX_H = 20;
    const AGE_MIN_F = 18;
    const AGE_MAX_F = 35;
    const SEUILS = [1200,2000,3500,5000,INF];
    const TAUX = [0,10,15,20,25];

    private int $age;
    private string $sexe;
    private float $salaire;

    public function __construct(int $age, string $sexe, float $salaire)
    {
        $this->age = $age;
        $this->sexe = $sexe;
        $this->salaire = $salaire;
    }

    public function estImposable(): bool
    {
        if ($this->sexe == self::HOMME and $this->age >= self::AGE_MAX_H)
            return true;
        else if ($this->sexe == self::FEMME and $this->age >= self::AGE_MIN_F and $this->age <= self::AGE_MAX_F)
            return true;
        else
            return false;
    }

    public function calculImpot() : float {
        if ($this->estImposable()) {
            foreach (self::SEUILS as $i => $seuil) {
                if ($this->salaire <= $seuil)
                    return $this->salaire*self::TAUX[$i]/100;
            }        
        }
        return 0;
    }
}
