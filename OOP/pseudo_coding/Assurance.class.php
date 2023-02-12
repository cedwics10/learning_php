<?php
class Assurance
{
    const TARIF = ['ROUGE', 'ORANGE', 'VERT', 'BLEU'];

    const AGE_SEUIL = 25;
    const AN_PERMIS_MIN = 2;

    private int $age;
    private int $anciennete;
    private int $dureePermis;
    private int $nombreAcc;

    private int $tarif = 4; // le tarif par défaut est bleu
    private bool $tarifCalcule = false;

    public function __construct(int $age, int $anciennete, int $dureePermis, int $nombreAcc)
    {
        $this->age = $age;
        $this->anciennete = $anciennete;
        $this->dureePermis = $dureePermis;
        $this->nombreAcc = $nombreAcc;
    }

    public function calculerTarif()
    {
        if ($this->tarifCalcule)
            return false;

        //$tarif-- : décrémente de 1
        if ($this->age <= self::AGE_SEUIL and $this->dureePermis <= self::AN_PERMIS_MIN)
            $this->tarif = $this->tarif - 3;
        else if ($this->age <= self::AGE_SEUIL and $this->dureePermis > self::AN_PERMIS_MIN)
            $this->tarif = $this->tarif - 2;
        else if ($this->age > self::AGE_SEUIL and $this->dureePermis <= self::AN_PERMIS_MIN)
            $this->tarif = $this->tarif - 1;

        $this->tarif = $this->tarif - $this->nombreAcc;

        if ($this->tarif < 0)
            return false;

        if ($this->anciennete >= self::AN_PERMIS_MIN) {
            $this->tarif = $this->tarif + 1;
        }
        $this->tarifCalcule = true;
    }

    public function getCouleur()
    {
        if (in_array($this->tarif, range(0, 3)))
            return self::TARIF[$this->tarif - 1];

        return "refusé";
    }
}
