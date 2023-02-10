<?php
function getGetter($type, $nom)
{
    $getter = "public function get" . ucfirst($nom) . "() : " . $type . "\n";
    $getter .= "{\n";
    $getter .= "\t" . ' return $this->' . $nom . ";\n";
    $getter .= "}\n";
    return $getter;
}

$resultat = "";
if (isset($_POST["btsubmit"])) {
    extract($_POST);
    //générer les getter et setter
    $arrayAttributs = explode("\n", trim($attributs));
    $resultats = [];
    foreach ($arrayAttributs as $cle => $attribut) {
        [$type, $nom] = explode(',', $attribut);
        $nom = trim($nom);
        $type = trim($type);
        $resultats[] = getGetter($type, $nom);
    }
    $resultat = implode("\n", $resultats);
}
