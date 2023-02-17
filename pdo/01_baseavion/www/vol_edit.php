<?php
require("../include/inc_config.php");
extract($_GET);
if (isset($_POST["btsubmit"])) {
    $_POST = array_map("mres", $_POST);
    extract($_POST);
    if ($vo_id > 0)
        //récupérer les données du formulaires et faire une requete de mise à jour des données de l'enregistrement
        $sql = "update vol set 
            vo_pilote='$vo_pilote', 
            vo_avion='$vo_avion',
            vo_site_depart='$vo_site_depart',
            vo_site_arrivee='$vo_site_arrivee',
            vo_heure_depart='$vo_heure_depart',
            vo_heure_arrivee='$vo_heure_arrivee'
            where vo_id=$vo_id";
    else
        $sql = "insert into vol values (null,'$vo_avion','$vo_pilote','$vo_site_depart','$vo_site_arrivee','$vo_heure_depart','$vo_heure_arrivee')";

    //execution de la requete
    if (mysqli_query($link, $sql))
        //si ok alors rediriger sur le crud avion
        header("location:vol_list.php");
    else
        //sinon afficher l'erreur
        echo mysqli_error($link);
} else if (isset($id)) {
    if ($id > 0) {
        //envoie d'une requête
        $result = mysqli_query($link, "select * from vol where vo_id=$id");
        //récupération un seul enregsitrement dans un tableau associatif
        $data = mysqli_fetch_assoc($result);
        $data = array_map("mhe", $data);
        extract($data);
    } else {
        $vo_id = 0;
        $vo_pilote = "";
        $vo_avion = "";
        $vo_site_depart = "";
        $vo_site_arrivee = "";
        $vo_heure_depart = "";
        $vo_heure_arrivee = "";
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
        <h1>CRUD de la table VOL : edit</h1>
        <form method="post">
            <input type="hidden" name="vo_id" id="vo_id" value="<?= $vo_id ?>">
            <p>
                <label>vo_id : </label><?= $vo_id ?>
            </p>
            <p>
                <label for="vo_avion">vo_avion</label>
                <select name="vo_avion" id="vo_avion">
                    <?php OPTION_avion($vo_avion); ?> 
                </select>
            </p>        
            <p>
                <label for="vo_pilote">vo_pilote</label>
                <select name="vo_pilote" id="vo_pilote">
                    <?php OPTION_pilote($vo_pilote); ?> 
                </select>
            </p>    
            <p>
                <label for="vo_site_depart">vo_site_depart</label>
                <select name="vo_site_depart" id="vo_site_depart">
                    <?php OPTION_ville($vo_site_depart); ?> 
                </select>
            </p>   
            <p>
                <label for="vo_site_arrivee">vo_site_arrivee</label>
                <select name="vo_site_arrivee" id="vo_site_arrivee">
                    <?php OPTION_ville($vo_site_arrivee); ?> 
                </select>
            </p>
            <p>
                <label for="vo_heure_depart">vo_heure_depart</label>
                <input type="time" name="vo_heure_depart" id="vo_heure_depart" value="<?=$vo_heure_depart?>">
            </p>
            <p>
                <label for="vo_heure_arrivee">vo_heure_arrivee</label>
                <input type="time" name="vo_heure_arrivee" id="vo_heure_arrivee" value="<?=$vo_heure_arrivee?>">
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