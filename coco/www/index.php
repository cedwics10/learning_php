<?php
/**
 * controleur principal : paramètres  m=module&a=action
 */
require "../application/config/config.php";

//paremetre $_GET m=module et a=action
if (!isset($_GET["m"]))
	$_GET["m"]="espace";

if (!isset($_GET["a"]))
	$_GET["a"]="index";

$module = "Ctr_" . $_GET["m"];
new $module($_GET["a"]);
