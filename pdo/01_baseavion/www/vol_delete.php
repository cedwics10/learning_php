<?php
require("../include/inc_config.php");
extract($_GET);
//envoie d'une requête
if (mysqli_query($link, "delete from vol where vo_id=$id"))
    header("location:vol_list.php");
else
    //sinon afficher l'erreur
    echo mysqli_error($link);
?>
