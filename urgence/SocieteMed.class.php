<?php
class SocieteMed
{
    public string $nom;
    public array $vehicules;
    public array $interventions;

    public function __construct($nom)
    {
        $this->nom = $nom;
        $this->vehicules = [];
        $this->interventions = [];
    }

    public function ajouterVehicule(Vehicule $v)
    {
        $this->vehicules[] = $v;
    }

    public function ajouterIntervention($id, $km)
    {
        $this->interventions[] = new Intervention($id, $km);
    }

    public function __toString()
    {
        $s = "Véhicules : <br>";
        foreach ($this->vehicules as $v)
            $s .= $v . "<br>";

        $s .= "Interventions : ";
        foreach ($this->interventions as $v)
            $s .= $v . "<br>";

        return $s;
    }

    private function coutVehicule($vehicule, $intervention)
    {
    }

    public function calculerCouts()
    {

        $couts = array_fill(0, count($this->interventions) - 1, 0);

        print_r($couts);
        exit();
        $i = 0;
        foreach ($this->interventions as $intervention) {
            foreach ($this->vehicules as $vehicule) {
                $couts[$i] += $this->coutVehicule($vehicule, $intervention);
            }
            $i++;
        }
    }
}
