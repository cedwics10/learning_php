<?php
require "Animal.class.php";
require "Chien.class.php";

$a = new Chien("Pluto", "Saint-Hubert", "DISNEY103");
$a->manger();
$a->crier();
// $a->mord();
echo $a;
