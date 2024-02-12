<?php
try {
    $sql = new PDO('mysql:host=localhost;dbname=guinot', 'root', '');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
