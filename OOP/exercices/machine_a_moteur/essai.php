<?php
require('Reservoir.class.php');
$reservoir = new Reservoir(10.0, 12.0);
$reservoir->remplir(5.0);
$reservoir->getNiveau();
$reservoir->getVolume();

echo $reservoir;
