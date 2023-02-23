<?php
class ClassGenerator
{
    //array of ["type"=>$type,"nom"=>$nom]
    private array $attributs;

    //$data : liste des attributs avec leur type
    public function __construct(string $data)
    {
        //séparer chaque ligne
        $lignes = explode("\n", $data);
        foreach ($lignes as $ligne) {
            [$type, $nom] = explode(" ", $ligne);
            $this->attributs[] = ["type" => trim($type), "nom" => trim($nom)];
        }
    }

    static public function getGetter($type, $nom): string
    {
        $s = "public function get" . ucfirst($nom) . "() : " . $type . "\n";
        $s .= "{ \n";
        $s .= "\t" . 'return $this->' . $nom . ";\n";
        $s .= "}\n\n";
        return $s;
    }

    static public function getSetter($type, $nom): string
    {
        $s = "public function set" . ucfirst($nom) . "($type \$$nom)\n";
        $s .= "{ \n";
        $s .= "\t" . '$this->' . $nom . " = \$$nom ;\n";
        $s .= "}\n\n";
        return $s;
    }

    public function getAllGetter() : string
    {
        $s = "";
        foreach ($this->attributs as $attribut)
            $s .= self::getGetter($attribut["type"], $attribut["nom"]);

        return $s;
    }

    public function getAllSetter() : string
    {
        $s = "";
        foreach ($this->attributs as $attribut)
            $s .= self::getSetter($attribut["type"], $attribut["nom"]);

        return $s;
    }

    public function getConstructeur() : string
    {
        $s="";
        $para=[];
        $aff="";
        foreach($this->attributs as $t) {
            $para[]=$t["type"] . " " . '$' . $t["nom"];
            $aff .= "\t" . '$this->' . $t["nom"] . ' = $' .  $t["nom"] . ";\n";
        }
        $spara=implode(",",$para);        

        $s="public function __construct($spara)\n";
        $s.="{\n";
        $s.=$aff;
        $s.="}\n\n";    

        return $s;
    }
}
