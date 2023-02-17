<?php
class AssurancePlus
{
    const TARIF = ['ROUGE', 'ORANGE', 'VERT', 'BLEU'];

    const AGE_SEUIL = 25;
    const AN_PERMIS_MIN = 2;

    private int $age;
    private int $anciennete;
    private int $dureePermis;
    private int $nombreAcc;

    private int $tarif;

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
        $tarif = 4; // le tarif par défaut est bleu

        //$tarif-- : décrémente de 1
        if ($this->age <= self::AGE_SEUIL and $this->dureePermis <= self::AN_PERMIS_MIN)
            $tarif = $tarif - 3;
        else if ($this->age <= self::AGE_SEUIL and $this->dureePermis > self::AN_PERMIS_MIN)
            $tarif = $tarif - 2;
        else if ($this->age > self::AGE_SEUIL and $this->dureePermis <= self::AN_PERMIS_MIN)
            $tarif = $tarif - 1;

        if ($this->anciennete >= self::AN_PERMIS_MIN) {
            $tarif = $tarif + 1;
        }
        $tarif = min($tarif - $this->nombreAcc, 4);
        $this->tarifCalcule = true;
    }

    public function getCouleur()
    {
        if (in_array($this->tarif, range(1, 4)))
            return self::TARIF[$this->tarif - 1];

        return "refusé";
    }
}
