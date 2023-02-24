<?php
class Intervention
{
    private string $id;
    private int $km;
    private array $blesses;

    public function __construct(string $id, int $km)
    {
        $this->id = $id;
        $this->km = $km;
        $this->blesses = [];
    }

    public function mobiliser(Vehicule $v)
    {
        $v->intervenir($this->id);
    }

    public function charger(Engin $v, string $nom)
    {
        $this->blesses[] = ["vehicule" => $v, "nom" => $nom];
        if (!$v->charger($this->id))
            echo "Erreur : impossible de charger $nom, " . $v->getId() . " est plein.";
    }

    public function __toString()
    {
        $s = "$this->id, km=$this->km <br>";
        foreach ($this->blesses as $ligne)
            $s .= $ligne["vehicule"] . " : " . $ligne["nom"] . "<br>";

        return $s;
    }
}
