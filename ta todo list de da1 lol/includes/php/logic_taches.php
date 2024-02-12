<?php
$select_options_categories = isset($_GET['id_categorie']) ? make_categories_list($_GET['id_categorie']) : make_categories_list();

if (isset($_GET['complete'])) {
	if (tache_exists($_GET['complete'])) {
		update_status($_GET['complete']);
		header('Location: index.php');
		exit();
	} else # pas ici
	{
		$error_message = 'La tâche à supprimer n\'existe pas.';
	}
}

if (isset($_POST['nouvelle_tache'])) # EDIT
{
	$error_message = insert_new_task();

	$id_categorie = htmlentities($_POST['id_categorie']);
	$nom_tache = htmlentities($_POST['nom_tache']);
	$date_tache = htmlentities($_POST['date_tache']);
}

if (isset($_GET['id_categorie']) and $_GET['id_categorie'] !== "") # EDIT
{
	$id_categorie = $_GET['id_categorie'];
	$sql = 'SELECT COUNT(categorie) FROM categories WHERE categories.id = ?';
	$statement = monSQL::getPdo()->prepare($sql);
	$statement->execute([$id_categorie]);

	$nb_cat_id = $statement->fetchColumn();

	if ($nb_cat_id === 1) {
		$texte_nom_cat = 'Tâches de la catégorie';
	} else {
		$texte_nom_cat = "La catégoriede numéro $id_categorie n'existe pas.";
	}
} else {
	$texte_nom_cat = 'Veuillez séléctionnet une catégorie';
}

if (isset($_POST['editer_tache']) and isset($_GET['editer'])) # EDIT
{
	$error_message = check_update_tache();
	if ($error_message === false)
		$error_message = update_tache();
}

if (isset($_GET['editer'])) # EDIT
{

	if (task_exists($_GET['editer'])) {

		$tache = select_row_tache($_GET['editer']);
		extract($tache);

		$complete = ($complete === 1) ? 'checked' : ''; # EDIT

		$date_tache = substr($date, 0, 10); # EDIT 
		$d_rappel_tache = substr($rappel, 0, 10); # EDIT
		$date_tache = substr($date, 0, 10); # EDIT

		$action_formulaire = 'Éditer la tâche : <i>"' . htmlentities($nom_tache) . '</i>"';
		$input_hidden = '<input type="hidden" name="editer_tache" />';

		$get_link = make_stripped_get_args_link([], ['editer' => $_GET['editer'], 'id_categorie' => $id_categorie]);
	}
}
