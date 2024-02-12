<?php
require('gabarit/header.php');
require('classes/Inscription.class.php');


checkAuth(false);

$dataTreatment = new Inscription($sql);
$responseMessage = $dataTreatment->checkData();
?>

<h1>Inscription au site</h1>
<h2><?= $responseMessage ?></h2>

<form action="inscription.php" method="post">
    <p>
        <label for="pseudo">Pseudo : </label>
        <input type="text" name="pseudo" id="pseudo" value="">
    </p>
    <p>
        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" id="mdp" value="">
    </p>

    <p>
        <label for="mdp">Type véhicule :</label>
        <select name="type">
            <option value="auto">Auto</option>
            <option value="moto">Moto</option>
        </select>
    </p>

    <input type="submit" name="bt_submit" value="Envoyer le formulaire">
</form>
<br />
<a href="index.php">Retour à la page d'index</a>
<?php
require('gabarit/footer.php')
?>