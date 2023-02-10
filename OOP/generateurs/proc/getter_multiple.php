<?php
include('func_getter.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur d'attributs</title>
</head>

<body>
    <form method="post">
        <p>
            <label for="attributs">LISTE DES ATTRIBUTS AVEC LEURS TYPES (séparation avec une virgule)</label>
            <?= $resultat ?>
        </p>
        <textarea rows="5" cols="100" id="attributs" name="attributs"><?= $attributs ?></textarea>
        <p>
            <input type="submit" name="btsubmit" value="Générer">
        </p>
        <hr />
        <textarea rows="20" cols="100" id="resultat" name="resultat"><?= $resultat ?></textarea>
    </form>
</body>

</html>