<?php
require("../include/inc_config.php");
extract($_GET);
//envoie d'une requête
$sql="delete from avion where av_id=:id";
//preparation de la requête
$pdostmt = $link->prepare($sql);
//lier les valeurs aux étiquettes en précisant leurs types 
$pdostmt->bindValue(":id",$id,PDO::PARAM_INT);
try {
    //exécute une requête préparée
    $pdostmt->execute();
    header("location:avion_list.php");
} catch(Exception $e) {
    echo $e->getMessage();
}
?>
