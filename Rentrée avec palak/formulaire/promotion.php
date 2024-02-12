<?php
require('connexion.php');

$mapPromo = [
    'CRCD' => 'CRCD',
    'DW' => 'Développeur web',
    'KINE' => 'Kiné'
];

$specifiedPromo = isset($_GET['promotion']) && array_key_exists($_GET['promotion'], $mapPromo);
$where = $specifiedPromo ? 'WHERE promotion =  "' . $mapPromo[$_GET['promotion']] . '"' : '';

$query = 'SELECT * FROM stagiaires ' . $where;
echo $query;

$requete = $sql->query($query);
$traineeTable = $requete->fetchAll(PDO::FETCH_DEFAULT);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Liste des étudiants de Guinot :</h1>
    <table>
        <tr>
            <td>Nom</td>
            <td>Prénom</td>
            <td>Date de naissance</td>
            <td>Sexe</td>
            <td>Promotion</td>
            <td>Informations</td>
            <td>Newsletter</td>
        </tr>
        <?php foreach ($traineeTable as $row) {
            $rowSexe = ($row['sexe'] == 1) ? 'Homme' : 'Femme';
            $rowNewsletter = ($row['newsletter'] == 1) ? 'Oui' : 'Non';

            $infos = empty($row['infos'])  ? 'Aucune info' : $row['infos'];

        ?>
            <tr>
                <td><?= htmlentities($row['nom']); ?></td>
                <td><?= htmlentities($row['prenom']); ?></td>
                <td><?= htmlentities($row['ddn']); ?></td>
                <td><?= $rowSexe ?></td>
                <td><?= htmlentities($row['promotion']); ?></td>
                <td><?= htmlentities($infos); ?></td>
                <td><?= $rowNewsletter ?></td>
            </tr>
        <?php } ?>
    </table>

    <a href="index.html">Retour à la page d'accueil.</a>
</body>

</html>