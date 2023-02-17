<?php
require("../include/inc_config.php");
extract($_GET);
if (isset($_POST["btsubmit"])) {
    $_POST = array_map("mres",$_POST);
    extract($_POST);
    if ($pi_id > 0)
        //récupérer les données du formulaires et faire une requete de mise à jour des données de l'enregistrement
        $sql = "update pilote set pi_nom='$pi_nom',pi_site='$pi_site' where pi_id=$pi_id";
    else
        $sql = "insert into pilote values (null,'$pi_nom','$pi_site')";

    //execution de la requete
    if (mysqli_query($link, $sql))
        //si ok alors rediriger sur le crud avion
        header("location:pilote_list.php");
    else
        //sinon afficher l'erreur
        echo mysqli_error($link);
} else if (isset($id)) {
    if ($id > 0) {
        //envoie d'une requête
        $result = mysqli_query($link, "select * from pilote where pi_id=$id");
        //récupération un seul enregsitrement dans un tableau associatif
        $data = mysqli_fetch_assoc($result);
        $data = array_map("mhe",$data);
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