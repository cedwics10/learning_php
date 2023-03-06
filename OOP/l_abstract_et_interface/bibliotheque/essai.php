<?php
require_once('includes/autoload.php');

$roman = new Roman('0234234', 'Voyage au bout de la nuit', 'L.F. Céline', 652, 'GONCOURT');
echo $roman;
echo 'Le prix littéraire est : "' . $roman->getPrixLitt() . "'\n";

$manuel = new Manuel('123456', 'Le BLED', 'ta prof de primaire', 100, 'CE1');
echo $manuel;

$dico = new Dictionnaire('12312', 'LAROUSSE', 1200, 'Français');
echo $dico;

$revue = new Revue('321874', 'L’éléphant', 259, 1, 2022);
echo $revue;

$bibliotheque = [$roman, $manuel, $dico, $revue];
// tester getNiveau en faisant du polymorphisme.
foreach ($bibliotheque as $document) {
    echo 'Le document est de niveau ' . $document->getNiveau() . "\n";
}
