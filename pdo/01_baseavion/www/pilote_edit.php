<?php
require("../include/inc_config.php");
extract($_GET);
if (isset($_POST["btsubmit"])) {
    $_POST = array_map("mres", $_POST);
    extract($_POST);
    if ($pi_id > 0) {
        $sql = "update pilote set pi_nom=:pi_nom,pi_site=:pi_site where pi_id=:pi_id";
        $stmt = $link->prepare($sql);
        $stmt->bindValue(":pi_nom", $av_const, PDO::PARAM_STR);
        $stmt->bindValue(":pi_site", $av_modele, PDO::PARAM_STR);
        $stmt->bindValue(":pi_id", $av_capacite, PDO::PARAM_INT);
    } else {
        $sql = "insert into pilote values (null,:pi_nom,:pi_site)";
        $stmt = $link->prepare($sql);
        $stmt->bindValue(":pi_nom", $av_const, PDO::PARAM_STR);
        $stmt->bindValue(":pi_site", $av_modele, PDO::PARAM_STR);
    }

    try {
        //exécute une requête préparée
        $stmt = $link->prepare($sql);
        $res = $stmt->execute($sql);
        header("location:pilote_list.php");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else if (isset($id)) {
    if ($id > 0) {
        //envoie d'une requête $id avec l'étiquette :id
        $sql = "select * from pilote where id=:id";
        $stmt = $link->prepare($sql);
        $stmt->bindValue("pi_id")

        $result = mysqli_query($link,);
        //récupération un seul enregsitrement dans un tableau associatif
        $data = $res->fetchAssoc();
        $data = array_map("mhe", $data);
        extract($data);
    } else {
        $pi_id = 0;
        $pi_nom = "";
        $pi_site = "";
    }
} else {
    //à voir
    echo mysqli_error($link);
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
        <h1>CRUD de la table PILOTE : edit</h1>
        <form method="post">
            <input type="hidden" name="pi_id" id="pi_id" value="<?= $pi_id ?>">
            <p>
                <label>pi_id : </label><?= $pi_id ?>
            </p>
            <p>
                <label for="pi_nom">pi_nom</label>
                <input type="text" name="pi_nom" id="pi_nom" value="<?= $pi_nom ?>">
            </p>
            <p>
                <label for="pi_site">pi_site</label>
                <select name="pi_site" id="pi_site">
                    <?php OPTION_ville($pi_site); ?>
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