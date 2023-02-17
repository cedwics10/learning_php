<?php
class Reservoir
{
    //contenance max du réservoir
    protected float $volume;
    //niveau d'essence
    protected float $niveau;

    public function __construct(float $volume, float $niveau)
    {
        if ($volume > 0)
            $this->volume = $volume;
        else
            echo "Erreur volume négatif impossible";

        $this->niveau = 0;
        $this->remplir($niveau);
    }

    public function getVolume(): float
    {
        return $this->volume;
    }

    public function getNiveau(): float
    {
        return $this->niveau;
    }

    public function remplir(float $v)
    {
        if ($v >= 0) {
            $x = $this->niveau + $v;
            if ($x >= 0 and $x <= $this->volume)
                $this->niveau = $x;
        }
    }

    public function vider(float $v): float
    {
        if ($v >= 0) {
            $lRestant = $this->niveau - $v;
            if ($lRestant >= 0 and $lRestant <= $this->volume) {
                $this->niveau = $lRestant;
                return 0.0;
            } else {
                $this->niveau = 0;
                return -$lRestant;
            }
        }
    }

    public function __toString(): string
    {
        return "Volume : $this->volume,<br />niveau : $this->niveau";
    }
}
