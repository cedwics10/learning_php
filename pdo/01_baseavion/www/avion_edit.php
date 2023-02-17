<?php
require("../include/inc_config.php");
extract($_GET);
if (isset($_POST["btsubmit"])) {    
    extract($_POST);
    if ($av_id > 0)
        //récupérer les données du formulaires et faire une requete de mise à jour des données de l'enregistrement
        $sql = "update avion set av_const=:av_const, av_modele=:av_modele, av_capacite=:av_capacite,av_site=:av_site where av_id=:av_id";
    else
        $sql = "insert into avion values (null,:av_const,:av_modele,:av_capacite,:av_site)";

    //preparation de la requête
    $pdostmt = $link->prepare($sql);
    //lier les valeurs aux étiquettes en précisant leurs types
    if ($av_id>0)
        $pdostmt->bindValue(":av_id",$av_id,PDO::PARAM_INT);

    $pdostmt->bindValue(":av_const",$av_const,PDO::PARAM_STR);
    $pdostmt->bindValue(":av_modele",$av_modele,PDO::PARAM_STR);
    $pdostmt->bindValue(":av_capacite",$av_capacite,PDO::PARAM_INT);
    $pdostmt->bindValue(":av_site",$av_site,PDO::PARAM_INT);

    try {
        //exécute une requête préparée
        $pdostmt->execute();
        header("location:avion_list.php");
    } catch(Exception $e) {
        echo $e->getMessage();
    }

    

} else if (isset($id)) {
    if ($id > 0) {
        //requete avec paramétre , noté avec :id
        $sql="select * from avion where av_id=:id";
        //prépare la requête
        $pdostmt = $link->prepare($sql);
        //lie une valeur à l'étiquette :id en précisant le type de la valeur
        $pdostmt->bindValue(":id",$id,PDO::PARAM_INT);
        //exécute une requête préparée
        $pdostmt->execute();
        //récupère l'enregistrement dans $row
        $data = $pdostmt->fetch();
        $data = array_map("mhe",$data);
        extract($data);
    } else {
        $av_id = 0;
        $av_const = "";
        $av_modele = "";
        $av_capacite = "";
        $av_site = "";
    }
} 
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require("../include/inc_head.php"); ?>
</head>

<body>
    <!-- lien de navigation pour lecteur d'écran -->
    <a href="#main" class="sr-only">aller au contenu principal</a>
    <!-- En-tête de page -->
    <header>
        <?php require("../include/inc_header.php"); ?>
    </header>

    <!-- menu de navigation -->
    <nav>
        <?php require("../include/inc_menu.php"); ?>
    </nav>

    <!-- contenu principal de la page -->
    <main id="main">
        <h1>CRUD de la table AVION : edit</h1>
        <form method="post">
            <input type="hidden" name="av_id" id="av_id" value="<?= $av_id ?>">
            <p>
                <label>av_id : </label><?= $av_id ?>
            </p>
            <p>
                <label for="av_const">av_const</label>
                <input type="text" name="av_const" id="av_const" value="<?= $av_const ?>">
            </p>
            <p>
                <label for="av_modele">av_modele</label>
                <input type="text" name="av_modele" id="av_modele" value="<?= $av_modele ?>">
            </p>
            <p>
                <label for="av_capacite">av_capacite</label>
                <input type="number" name="av_capacite" id="av_capacite" value="<?= $av_capacite ?>">
            </p>
            <p>
                <label for="av_site">av_site</label>
                <select name="av_site" id="av_site">
                    <?php OPTION_ville($av_site); ?>
                </select>
            </p>
            <input type="submit" name="btsubmit">
        </form>
    </main>

    <!-- pied de page -->
    <footer>
        <?php require("../include/inc_footer.php"); ?>
    </footer>
</body>

</html>