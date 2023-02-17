<?php
require("../include/inc_config.php");
extract($_GET);
if (isset($_POST["btsubmit"])) {
    $_POST = array_map("mres",$_POST);
    extract($_POST);
    if ($vi_id > 0)
        //récupérer les données du formulaires et faire une requete de mise à jour des données de l'enregistrement
        $sql = "update ville set vi_nom='$vi_nom' where vi_id=$vi_id";
    else
        $sql = "insert into ville values (null,'$vi_nom')";

    //execution de la requete
    if (mysqli_query($link, $sql))
        //si ok alors rediriger sur le crud avion
        header("location:ville_list.php");
    else
        //sinon afficher l'erreur
        echo mysqli_error($link);
} else if (isset($id)) {
    if ($id > 0) {
        //envoie d'une requête
        $result = mysqli_query($link, "select * from ville where vi_id=$id");
        //récupération un seul enregsitrement dans un tableau associatif
        $data = mysqli_fetch_assoc($result);
        $data = array_map("mhe",$data);
        extract($data);
    } else {
        //création d'un enregistrement
        $vi_id = 0;
        $vi_nom = "";        
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
        <h1>CRUD de la table VILLE : edit</h1>
        <form method="post">
            <input type="hidden" name="vi_id" id="vi_id" value="<?= $vi_id ?>">
            <p>
                <label>vi_id : </label><?= $vi_id ?>
            </p>
            <p>
                <label for="vi_nom">vi_nom</label>
                <input type="text" name="vi_nom" id="vi_nom" value="<?= $vi_nom ?>">
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