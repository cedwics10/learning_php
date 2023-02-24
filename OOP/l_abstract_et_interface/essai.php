<?php
require_once('Animal.class.php');
require_once('Chat.class.php');
require_once('Chien.class.php');
require_once('Cheval.class.php');

// $animal = new Animal('BUG', 0); // Fatal error: Uncaught Error: Cannot instantiate abstract class Animal
$chat = new Chat('Titi', 10);
$chien = new Chien('Rantanplan', 8);
$cheval = new Cheval('Jolly jumper', 9);

$animaux = [$chat, $chien, $cheval];

foreach ($animaux as $animal) {
    echo $animal->makesound() . '<br />';
}
