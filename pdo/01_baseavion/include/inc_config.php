<?php
//https://www.php.net/manual/fr/intro.pdo.php
//https://www.php.net/manual/fr/class.pdo.php
require "inc_fonctions.php";
session_start();
const NOM_DU_SITE = "base Avion";
try {
    //connexion à la base de données
    $link = new PDO("mysql:host=localhost;port=3306;dbname=baseavion", "root", "");
    //envoie la commande suivante au server MYSQL
    $link->exec("SET CHARACTER SET UTF8");
    //Définit le mode de la méthode fetch par défaut
    $link->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    //déclenche une exception en cas d'erreur
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    //affiche le message et stop le script PHP
    die($e->getMessage());
}
