<?php
//un engin est un véhicule qui peut transporter des blessés
class Engin extends Vehicule {

    protected int $capacite;

    public function __construct(string $id, int $capacite)
    {
        parent::__construct($id);
        $this->capacite=$capacite;
    }

    //un blessé supplémentaire est chargé dans le véhicule pour l'intervention $id
    public function charger(string $id) : bool {
        if ($this->interventions[$id]<$this->capacite) {
            $this->interventions[$id]++;
            return true;
        } 

        return false;        
    }
}