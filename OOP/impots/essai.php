<?php
require 'Formulaire.class.php';
echo Formulaire::createRadios('Région', [
    'IDF' => 'idf',
    'Marseille' => 'marseille',
    'Lyon' => 'lyon',
], 'Paris');
