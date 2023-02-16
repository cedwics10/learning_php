<?php
require "Impots.class.php";

//intialisation des variables
$message = "";
$montant = "";
$age="";
$sexe="";
$salaire="";
//si on a reçu des données du formulaire
if (isset($_POST["btsubmit"])) {    
    extract($_POST);    
    $impots=new Impots($age,$sexe,$salaire);
    $message=$impots->estImposable() ? " Vous êtes imposable" : "Vous n'êtes pas imposable";
    $montant=$impots->calculImpot();
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
            <label for="age">Age : </label>
            <input type="number" id="age" name="age" value="<?=$age?>">
        </p>
        <p>
            <label for="sexe">SEXE (H ou F) : </label>
            <input type="text" id="sexe" name="sexe" value="<?=$sexe?>">
        </p>
        <p>
            <label for="salaire">Salaire mensuel : </label>
            <input type="number" id="salaire" name="salaire" value="<?=$salaire?>">
        </p>
        <input type="submit" value="Envoyer" name="btsubmit">
    </form>
    <hr>
    <h3><?=$message ?></h3>
    <h3><?=$montant ?></h3>
    <?php echo Impots::AGE_MAX_F; ?>

</body>

</html>