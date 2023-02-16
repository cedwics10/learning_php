<?php

require('Salarie.class.php');
require('Commercial.class.php');
require('TechnicienSpe.class.php');
require('Entreprise.class.php');


$travailleur = new Salarie('Jean', 1, 1);
echo $travailleur;

$travailleur2 = new Salarie('Jacques', 2, 1.2);
echo $travailleur2;

$commercial = new Commercial('Paul', 3, 1.5, 10.0);
echo $commercial;

$entreprise = new Entreprise('Guinot Corp');

$entreprise->ajouterSalarie($travailleur);
$entreprise->ajouterSalarie($travailleur);
$entreprise->ajouterSalarie($commercial);
echo $entreprise;

$technicien = new TechnicienSpe('Henri', 4, 1.5, 1.0);
echo $technicien;

$entreprise->ajouterSalarie($technicien);
echo $entreprise;
