<?php
session_start();
$_SESSION['pseudo'] = NULL;
$_SESSION['mot_de_passe'] = NULL;
session_destroy();
header('Location: index.php');
?>