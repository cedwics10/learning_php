<?php
class SocieteMed {
    public string $nom;
    public array $vehicules;
    public array $interventions;

    public function __construct($nom) 
    {
        $this->nom=$nom;
        $this->vehicules=[];
        $this->interventions=[];
    }

    public function ajouterVehicule(Vehicule $v) {
        $this->vehicules[]=$v;
    }

    public function ajouterIntervention($id,$km) {
        $this->interventions[]=new Intervention($id,$km);
    }

    public function __toString()
    {
        $s="Véhicules : <br>";
        foreach($this->vehicules as $v)
            $s.=$v . "<br>";

        $s.="Interventions : ";
        foreach($this->interventions as $v)
            $s.=$v . "<br>";
        
        return $s;
    }

}