<?php
require "Animal.class.php";
require "Chien.class.php";

$pluto = new Chien("Pluto", "Saint-Hubert", "DISNEY103");

$pluto->manger();
$pluto->crier();


echo $pluto;
