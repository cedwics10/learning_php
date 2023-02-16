<?php
class Commercial extends Salarie
{
    protected static float $taux = 10.0;
    protected float $ventes;

    public function __construct(string $nom, int $id, float $salaire, float $ventes)
    {
        parent::__construct($nom, $id, $salaire);
        $this->ventes = $ventes;
    }

    public function setVente(float $v)
    {
        if ($v >= 0)
            $this->ventes = $v;
    }

    public function getSalaire(): float
    {
        $salaireBase = parent::getSalaire();
        $salaireTotal = (self::$taux / 100) * $this->ventes + $salaireBase;
        return $salaireTotal;
    }

    public function __toString(): string
    {
        return parent::__toString() . $this->nom . ' est un commercial.<br />';
    }
}
