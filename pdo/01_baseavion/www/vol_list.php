<?php
require("../include/inc_config.php");
//envoie d'une requête
$sql="
select 
    vo_id, 
    pi_nom,
    av_const,
    depart.vi_nom 'ville départ',
    arrivee.vi_nom 'ville arrivée',
    vo_heure_depart,
    vo_heure_arrivee
from 
    vol,
    pilote,
    avion,
    ville depart,
    ville arrivee 
where 
    vo_pilote=pi_id and
    vo_avion=av_id and 
    vo_site_depart=depart.vi_id and
    vo_site_arrivee=arrivee.vi_id 
order by
    vo_id";

$result = mysqli_query($link, $sql);
//récupération de tous les enregistrements dans un tableau
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        <h1>CRUD de la table VOL</h1>
        <p><a href="vol_edit.php?id=0">Nouvel enregistrement</a></p>
        <table>
            <tr>
                <?php
                if (count($data) > 0)
                    foreach ($data[0] as $cle => $valeur) {
                        echo "<th>$cle</th>";
                    }
                ?>
            </tr>
            <?php
            foreach ($data as $num => $ligne) {
                echo "<tr>";
                foreach ($ligne as $cle => $valeur) {
                    //protection contre l'injection de javascript/HTML
                    $valeur=htmlentities($valeur,ENT_QUOTES,"UTF-8");
                    echo "<td>$valeur</td>";
                }
                echo "<td><a href='vol_edit.php?id={$ligne["vo_id"]}'>Edit</a></td>"; 
                echo "<td><a href='vol_delete.php?id={$ligne["vo_id"]}'>Delete</a></td>"; 
                echo "</tr>";
            }
            ?>
        </table>
    </main>

    <!-- pied de page -->
    <footer>
        <?php require("../include/inc_footer.php"); ?>
    </footer>
</body>

</html>