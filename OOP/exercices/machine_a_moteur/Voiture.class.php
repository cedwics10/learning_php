<?php
class Voiture extends MachineAMoteur
{
    private float $conso;
    public function __construct(float $volume, float $niveau, float $conso)
    {
        parent::__construct($volume, $niveau);
        $this->conso = $conso;
    }

    public function __toString()
    {
        return parent::__toString()  . " Litres au 100 : " . $this->conso . "<br />________<br /><br />";
    }

    public function rouler(int $km)
    {
        $consoTot = $km / 100 *  $this->conso;
        $excedant = $this->reservoir->vider($consoTot);

        if ($this->reservoir->getNiveau() <= 0) {
            echo 'Le réservoir de votre voitrure est à sec<br />';
            echo "Il manquait $excedant L pour arriver à destination.<br />";
            echo 'Nous sommes à ' . ((1 / $this->conso) * ($excedant) * 100) . ' km de la destination visée.<br />';
            return false;
        }
    }
}
