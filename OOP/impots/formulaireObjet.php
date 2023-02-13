<?php
require "Formulaire.class.php";
require "Impots.class.php";

//intialisation des variables
$message = "";
$montant = "";
$age = "";
$sexe = "";
$salaire = "";
//si on a reçu des données du formulaire
if (isset($_POST["btsubmit"])) {
    extract($_POST);
    $impots = new Impots($age, $sexe, $salaire);
    $message = $impots->estImposable() ? " Vous êtes imposable" : "Vous n'êtes pas imposable";
    $montant = $impots->calculImpot();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>impots</title>
</head>

<body>
    <form method="post">
        <p>
            <?= Formulaire::createLabel("Age", "age") ?>
            <?= Formulaire::createInput("number", "age", $age) ?>
        </p>
        <p>
            <?= Formulaire::createLabel("Genre", "genre") ?>
            <?php //Formulaire::createSelect("genre",["H"=>"Homme","F"=>"Femme"],$genre) 
            ?>
            <?= Formulaire::createRadios("genre", ["H" => "Homme", "F" => "Femme"], $genre) ?>
        </p>
        <p>
            <?= Formulaire::createLabel("Salaire Mensuel", "salaire") ?>
            <?= Formulaire::createInput("number", "salaire", $salaire) ?>
        </p>
        <?= Formulaire::createInput("submit", "btsubmit", "Envoyer") ?>
    </form>
    <hr>
    <h3><?= $message ?></h3>
    <h3><?= $montant ?></h3>
    <?php echo Impots::AGE_MAX_F; ?>

</body>

</html>