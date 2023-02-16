<?php
class Commercial extends Salarie
{
    static float $taux = 10.0;
    private float $vente;

    public function setVente($v)
    {
        $this->vente = $v;
    }

    public function getSalaire(): float
    {
        $salaireBase = parent::getSalaire();
        $salaireTotal = (1 + $this->vente) * $salaireBase;
        return $salaireTotal;
    }
}
