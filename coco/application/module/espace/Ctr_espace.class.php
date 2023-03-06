<?php
/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
*/
class Ctr_espace extends Ctr_controleur implements I_crud {

    public function __construct($action) {
        parent::__construct("espace", $action);        
        $a = "a_$action";
        $this->$a();
    }

	function a_index() {
		$u=new Espace();
		$data=$u->selectAll();
		require $this->gabarit;
	}
	
	//$_GET["id"] : id de l'enregistrement
	function a_edit() {		
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u=new Espace();
		if ($id>0)
			$row=$u->select($id);
		else
			$row=$u->emptyRecord();
			
		extract($row);	
		require $this->gabarit;		
	}

	//$_POST
	function a_save() {
		if (isset($_POST["btSubmit"])) {
			$u=new Espace();
			$u->save($_POST);
			if ($_POST["esp_id"]==0)
				$_SESSION["message"][]="Le nouvel enregistrement Espace a bien été créé.";
			else
				$_SESSION["message"][]="L'enregistrement Espace a bien été mis à jour.";
		}
		header("location:" . hlien("espace"));
	}

	

	//param GET id 
	function a_delete() {
		if (isset($_GET["id"])) {
			$u=new Espace();
			$u->delete($_GET["id"]);
			$_SESSION["message"][]="L'enregistrement Espace a bien été supprimé.";
		}
		header("location:" . hlien("espace"));
	}
}

?>