<?php
require "Reservoir.class.php";
require "MachineAMoteur.class.php";
require "Voiture.class.php";

$machine = new Voiture(100, 50, 10);

$machine->faireLePlein();
echo $machine;

$machine->rouler(100);
echo $machine;

$machineDeux = new Voiture(50, 50, 10);
echo $machineDeux;
$machineDeux->rouler(600);
echo $machineDeux;
