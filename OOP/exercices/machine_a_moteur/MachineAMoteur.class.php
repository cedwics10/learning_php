<?php
class MachineAMoteur
{
    protected Reservoir $reservoir;

    public function __construct(float $volume, float $niveau)
    {
        $this->reservoir = new Reservoir($volume, $niveau);
    }

    public function getReservoir(): Reservoir
    {
        return $this->reservoir;
    }

    public function faireLePlein()
    {
        //les attributs de $reservoir (volume et niveau) ne sont pas accessible directement
        $this->reservoir->remplir($this->reservoir->getVolume() - $this->reservoir->getNiveau());
    }

    public function __toString(): string
    {
        return "Reservoir : $this->reservoir<br />";
    }
}
