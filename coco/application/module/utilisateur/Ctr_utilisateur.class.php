<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_utilisateur extends Ctr_controleur implements I_crud
{

	public function __construct($action)
	{
		parent::__construct("utilisateur", $action);
		$a = "a_$action";
		$this->$a();
	}

	function cannot_edit_profile(int $id): bool
	{
		return  $id > 0
			and (!isset($_SESSION['uti_profil'])
				or $_SESSION['uti_profil'] != 'admin'
			)
			and (!isset($_SESSION['uti_id'])
				or $_SESSION['uti_id'] != $_GET['id']
			);
	}

	function a_index()
	{
		$u = new Utilisateur();
		$data = $u->selectAll();
		require $this->gabarit;
	}

	//$_GET["id"] : id de l'enregistrement
	function a_edit()
	{
		if (!isset($_SESSION['uti_profil'])) {
			header('Location: ' . hlien());
		}

		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Utilisateur();

		if ($this->cannot_edit_profile($id)) {
			header('Location: ' . hlien("utilisateur"));
			exit();
		} else if ($id > 0)
			$row = $u->select($id);
		else
			header('Location: ' . hlien("utilisateur"));

		extract($row);
		require $this->gabarit;
	}

	//$_POST
	function a_save()
	{
		if (isset($_POST["btSubmit"])) {
			$u = new Utilisateur();
			if ($_POST['uti_mdp']) {
			}
			$u->save($_POST);
			if ($_POST["uti_id"] == 0)
				$_SESSION["message"][] = "Le nouvel enregistrement Utilisateur a bien été créé.";
			else
				$_SESSION["message"][] = "L'enregistrement Utilisateur a bien été mis à jour.";
		}
		header("location:" . hlien("utilisateur"));
	}



	//param GET id 
	function a_delete()
	{
		if (isset($_GET["id"])) {
			$u = new Utilisateur();
			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Utilisateur a bien été supprimé.";
		}
		header("location:" . hlien("utilisateur"));
	}
}
