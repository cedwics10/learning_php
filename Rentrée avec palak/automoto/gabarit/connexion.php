<?php
session_start();
error_reporting(E_ALL);

try {
    $sql = new PDO('mysql:host=localhost;dbname=guinot', 'root', '');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

function checkAuth(bool $checkConnecte = true)
{
    // $memberOnline = isset($_SESSION['pseudo']);

    // $checkConnecte = $checkConnecte && $memberOnline;
    // $checkNonConnecte = !$checkConnecte && !$memberOnline;
    // if ($checkConnecte || $checkNonConnecte)
    //     return false;

    // echo 'Vous n\'êtes pas autorisé à venir ici. <a href="index.php">INDEX</a>';
    // exit();
}
