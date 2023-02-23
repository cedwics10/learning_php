<?php
class Vehicule
{
    protected string $id;
    //tableau associatif où cle=num d'intervention et valeur=nombre de blessés chargés
    protected array $interventions;

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->interventions = [];
    }

    //vehicule mobiliser pour une intervention
    public function intervenir(string $id) {
        $this->interventions[$id]=0;
    }    

    public function __toString() : string
    {
        $s="";        
        $s.= get_class($this) . " : $this->id <br>";
        foreach($this->interventions as $cle => $valeur)
            $s.="- $cle : $valeur personnes<br>";
        return $s;
    }

    public function getId():string {
        return $this->id;
    }

}
