<?php
require("../include/inc_config.php");
extract($_GET);
//envoie d'une requête
if (mysqli_query($link, "delete from pilote where pi_id=$id"))
    header("location:pilote_list.php");
else
    //sinon afficher l'erreur
    echo mysqli_error($link);
?>
