<?php

use const PHPSTORM_META\ANY_ARGUMENT;

interface Scolaire
{
    const NIVEAUX = ['CP', 'CE1', 'CE2', 'CM1', 'CM2', 'Collège', 'Lycée', 'Supérieur', 'Autre'];
    public function getNiveau(): string;
}
