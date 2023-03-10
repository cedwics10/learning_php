<?php
require("../include/inc_config.php");
//envoie d'une requête
$result = mysqli_query($link, "select * from ville order by vi_nom");
//récupération de tous les enregsitrements dans un tableau
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
        <h1>CRUD de la table VILLE</h1>
        <p><a href="ville_edit.php?id=0">Nouvel enregistrement</a></p>
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
                echo "<td><a href='ville_edit.php?id={$ligne["vi_id"]}'>Edit</a></td>"; 
                echo "<td><a href='ville_delete.php?id={$ligne["vi_id"]}'>Delete</a></td>"; 
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