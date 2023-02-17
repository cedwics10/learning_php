<?php
require 'AssurancePlus.class.php';

$tarifFinal = '';

$age = '';
$anciennete = '';
$dureePermis = '';
$nombreAcc = '';

if (isset($_POST['btsubmit'])) {
    extract($_POST);
    $Client = new AssurancePlus($age, $anciennete, $dureePermis, $nombreAcc);
    $Client->calculerTarif();
    $tarifFinal = $Client->getCouleur();
}

$texteTarifFinal = ($tarifFinal != '') ? "Votre tarif est : {$tarifFinal}" : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logique assurance plus</title>
</head>

<body>
    <h1>Tarif assurance plus (POO)</h1>
    <h2><?= $texteTarifFinal ?></h2>
    <form method="post">
        <label for="age">Votre âge :</label> <input type="number" name="age" value="<?= $age ?>" /><br />
        <label for="anciennete">Votre ancienneté :</label> <input type="number" name="anciennete" value="<?= $anciennete ?>" /><br />
        <label for=" dureePermis">Depuis combien de temps avez-vous eu le permis</label> <input type="number" name="dureePermis" value="<?= $dureePermis ?>" /><br />
        <label for=" nombreAcc">Le nombre d'accidents :</label> <input type="number" name="nombreAcc" value="<?= $nombreAcc ?>" /><br />
        <input type="submit" value="Envoyer" />
        <input type="hidden" name="btsubmit" />
    </form>
</body>

</html>