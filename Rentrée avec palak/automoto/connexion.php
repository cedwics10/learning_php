<?php
require('gabarit/header.php');
require('classes/Connexion.class.php');

checkAuth(true);

$dataTreatment = new Connexion($sql);
$responseMessage = $dataTreatment->checkData();
?>

<h1>Connexion au site</h1>
<h2><?= $responseMessage ?></h2>

<form action="connexion.php" method="post">
    <p>
        <label for="pseudo">Pseudo : </label>
        <input type="text" name="pseudo" id="pseudo" value="">
    </p>
    <p>
        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" id="mdp" value="">
    </p>
    <input type="submit" name="bt_submit" value="Envoyer le formulaire">
</form>
<br />
<a href="index.php">Retour à la page d'index</a>

<?php
require('gabarit/footer.php')
?>