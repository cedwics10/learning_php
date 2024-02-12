<?php
require('connexion.php');

function sendIntoDatabase($sql)
{
    $statement = $sql->prepare('INSERT INTO stagiaires(prenom, nom, ddn, sexe, promotion, infos, newsletter)
    VALUES (:prenom, :nom, :ddn, :sexe, :promotion, :infos, :newsletter)');

    $statement->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
    $statement->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
    $statement->bindValue(':ddn', $_POST['ddn'], PDO::PARAM_STR);

    $statement->bindValue(':sexe', $_POST['sexe'], PDO::PARAM_BOOL);
    $statement->bindValue(':promotion', $_POST['promotion'], PDO::PARAM_STR);

    $infos = isset($_POST['infos']) ?  implode(',', $_POST['infos']) : '';

    $statement->bindValue(':infos', $infos, PDO::PARAM_STR);
    if (!isset($_POST['newsletter'])) $_POST['newsletter'] = 0;
    $statement->bindValue(':newsletter', $_POST['newsletter'], PDO::PARAM_BOOL);

    $statement->execute();

    echo '<h1>Le formulaire est correct monsieur. Il a été envoyé à la base de données. </h1><br />';
}

function errorMessage()
{
    $undefinedName = empty($_POST['nom']) || empty($_POST['prenom']);
    if ($undefinedName) return 'Le prénom ou le nom n\'a pas été spécifié';

    $undefinedSex = !isset($_POST['sexe']) or !in_array($_POST['sexe'], [0, 1]);
    if ($undefinedSex) return 'Êtes-vous un homme ou une femme ??';


    if (isset($_POST['date']))
        list($year, $month, $day) = explode('-', $_POST['date']);
    else
        [$year, $month, $day] = [2000, 15, 38]; // invalid date

    $otherDataNotValid = empty($_POST['promotion'])
        or isset($_POST['date']) or checkdate($month, $day, $year);
    if ($otherDataNotValid) return 'Les informations complémentaires ne sont pas spécifiés.';


    return null;
}

if (isset($_POST['bt_submit'])) {
    $errorText = errorMessage();
    if (!is_null($errorText)) {
        exit($errorText . ' <a href="index.html">Retour à l\'index.</a>');
    }

    sendIntoDatabase($sql);
} else {
    exit('Vous n\'avez pas envoyé le formulaire. <a href="index.html">Retour à l\'index.</a>');
}
?>
<br /><br />
<a href="index.html">Retour à l\'index.</a>