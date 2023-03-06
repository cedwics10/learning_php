<?php

//fabrique un lien en passant les parametres un par un à savoir :
// module, action, [cle, valeur]...
function hlien()
{
	$args = func_get_args();

	if (count($args) == 0)
		return "index.php";

	if (count($args) == 1)
		return "index.php?m=" . $args[0];

	$nb = count($args) / 2;
	if (!is_int($nb)) {
		throw new Exception("ERREUR : Nombre d'arguments dans l'url incorrect");
	}
	$m = $args[0];
	$a = $args[1];

	if (!isset($args[2]))
		return "index.php?m=$m&a=$a";
	else {
		$para = array();
		for ($i = 1; $i < $nb; $i++)
			$para[] = $args[2 * $i] . "=" . $args[2 * $i + 1];
		$s = implode("&", $para);
		return "index.php?m=$m&a=$a&$s";
	}
}

/**
Autoload : 
- les controleurs sont dans le répertoire "module", le fichier est préfixé par "Ctr_"
- les classes Table sont dans le répertoire "_table"
 */
function monAutoLoad($classname)
{
	if ("Ctr_" == substr($classname, 0, 4)) {
		$rep = str_replace("Ctr_", "", $classname);
		require_once "../application/module/$rep/" . $classname . ".class.php";
	} else {
		if (file_exists("../application/table/" . $classname . ".class.php"))
			require_once "../application/table/" . $classname . ".class.php";
	}
}

function monExceptionHandler($e)
{
	die("Erreur : " . $e->getMessage());
}

/*
Affiche un tableau PHP à 2 dimensions sous la forme d'une table HTML
*/
function afficheTableHTML($data)
{
	$fin = false;
	echo "<table>";
	foreach ($data as $cleLigne => $ligne) {
		//affiche des entete de colonnes
		if (!$fin) {
			echo "<tr>";
			echo "<th></th>";
			foreach ($ligne as $cle => $valeur) {
				echo "<th>$cle</th>";
			}
			echo "</tr>";
			$fin = true;
		}

		//affichage du tableau
		echo "<tr>";
		echo "<th>$cleLigne</th>";
		foreach ($ligne as $cle => $valeur) {
			echo "<td>$valeur</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}

//si user non authentifié redirection vers index
function checkAuth()
{
	if (!isset($_SESSION["uti_id"])) {
		$_SESSION["message"][] = "accès non autorisé. Veuillez vous connecter.";
		header("location:" . hlien("_default"));
		exit;
	}
}

//si user non authentifié redirection vers index
function checkAllow($profil)
{
	checkAuth();
	if ($_SESSION["uti_profil"] != $profil) {
		$_SESSION["message"][] = "accès non autorisé.";
		header("location:" . hlien("_default"));
		exit;
	}
}

//anti sql injection : NE PAS UTILISER AVEC DES REQUETES PREPAREES 
function mres($s)
{
	return Table::$link->quote($s);
}

/**
Traitement des chaines anti XSS avant affichage dans une page HTML.
 */
function mhe($x)
{
	return htmlentities($x, ENT_QUOTES, "utf-8");
}

/**
 * DEBUG
 */
function debug($t)
{
	echo "<pre>";
	print_r($t);
	echo "</pre>";
}

/* Est utilisateur/admin */
function estUtilisateur()
{
	return (isset($_SESSION['uti_profil']));
}

function estAdministrateur()
{
	return (estUtilisateur() && $_SESSION['uti_profil'] == 'admin');
}
