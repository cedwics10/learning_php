<?php
class ClassGenerator
{
    //array of ["type"=>$type,"nom"=>$nom]
    private array $attributs;
    private array $constArgs;
    private string $classname;

    //$data : liste des attributs avec leur type
    public function __construct(string $classname, string $data,  string $constArgs = '')
    {
        $this->classname = $classname;
        //séparer chaque ligne des variables get/set
        $lignes = explode("\n", $data);
        foreach ($lignes as $ligne) {
            [$type, $nom] = explode(",", $ligne);
            $this->attributs[] = ["type" => trim($type), "nom" => trim($nom)];
        }

        // séparer chaque ligne des arguments du constructeur
        $lignes = explode("\n", $constArgs);
        print_r($lignes);
        foreach ($lignes as $ligne) {
            [$type, $nom] = explode(",", $ligne);
            $this->constArgs[] = ["type" => trim($type), "nom" => trim($nom)];
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

    static public function getConstructor($type, $nom): string
    {
        $s = "public function __construct(" . implode(',', $this->constArgs) . ")\n";
        $s .= "{ \n";
        $s .= "\t" . '$this->' . $nom . " = \$$nom ;\n";
        $s .= "}\n\n";
        return $s;
    }

    public function getAllGetter()
    {
        $s = "";
        foreach ($this->attributs as $attribut)
            $s .= self::getGetter($attribut["type"], $attribut["nom"]);

        return $s;
    }

    public function getAllSetter()
    {
        $s = "";
        foreach ($this->attributs as $attribut)
            $s .= self::getSetter($attribut["type"], $attribut["nom"]);

        return $s;
    }

    public function getConstructeur()
    {
        //to do
    }
}
