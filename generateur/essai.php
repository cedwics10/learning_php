<?php
require "ClassGenerator.class.php";

$attributs = "";
$resultat = "";
if (isset($_POST["btsubmit"])) {
    extract($_POST);
    $cl = new ClassGenerator($attributs);
    $resultat .= $cl->getConstructeur();
    $resultat .= $cl->getAllGetter();
    $resultat .= $cl->getAllSetter();

}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <p><label>LISTE DES ATTRIBUTS AVEC LEURS TYPES</label></p>
        <textarea rows="5" cols="50" id="attributs" name="attributs"><?= $attributs ?></textarea>
        <p><input type="submit" name="btsubmit" value="Générer"></p>
        <hr>
        <textarea rows="20" cols="100"><?= $resultat ?></textarea>
    </form>
</body>

</html>