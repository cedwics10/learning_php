<?php
require_once('includes/autoload.php');
$livre = new Livre('0234234', 'La programmation pour les nuls', 'LES NULS', 300);
echo $livre;
$roman = new Roman('0234234', 'Voyage au bout de la nuit', 'L.F. Céline', 652);
echo $roman;
$manuel = new Manuel('123456', 'Le BLED', 'ta prof de collège', 100, 'CE1');
echo $manuel;
$dico = new Dictionnaire('12312', 'LAROUSSE', 1200, 'Français');
echo $dico;
