<?php
require("../include/inc_config.php");
extract($_GET);
//envoie d'une requête
if (mysqli_query($link, "delete from ville where vi_id=$id"))
    header("location:ville_list.php");
else
    //sinon afficher l'erreur
    echo mysqli_error($link);
?>
