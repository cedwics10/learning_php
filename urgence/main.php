<?php
require_once "Vehicule.class.php";
require_once "Engin.class.php";
require_once "PC.class.php";
require_once "Vs.class.php";
require_once "Va.class.php";
require_once "SocieteMed.class.php";
require_once "Intervention.class.php";

$societe = new SocieteMed("Santé med");
// Créer les véhicules
// Créer les véhicules
$pc1 = new PC("pc1");
$pc2 = new PC("pc2");
$vs1 = new VS("vs1");
$vs2 = new VS("vs2");
$vs3 = new VS("vs3");
$va1 = new VA("va1");
$va2 = new VA("va2");

$societe->ajouterVehicule($pc1);
$societe->ajouterVehicule($pc2);
$societe->ajouterVehicule($vs1);
$societe->ajouterVehicule($vs2);
$societe->ajouterVehicule($vs3);
$societe->ajouterVehicule($va1);
$societe->ajouterVehicule($va2);

//créer une intervention
$societe->ajouterIntervention("inter1", 32);
$societe->interventions[0]->mobiliser($pc1);
$societe->interventions[0]->mobiliser($vs2);
$societe->interventions[0]->charger($vs2, "Dupond");
$societe->interventions[0]->charger($vs2, "Machin");
$societe->interventions[0]->charger($vs2, "Inconnu");
$societe->interventions[0]->mobiliser($va1);
$societe->interventions[0]->charger($va1, "Bidule");

echo $societe;

echo $societe->calculerCouts();
