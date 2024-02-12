<?php

require_once('../includes/php/include_index.php');

if (!connecte()) {
	header('Location: index.php');
	exit();
}

/* Début - EDIT */
$action_change_categorie = '';

$action_formulaire = 'Créer une tâche';
$description_categories = '';
$get_link = '';
$error_message = '';
$texte_nom_cat = '';

$nom_tache = '';
$date_tache = date("Y-m-d");
$d_rappel_tache = date("Y-m-d");
$id_categorie = '';
$description = '';
$complete = "1";
$importance = MIN_IMPORTANCE_TASKS;
$input_hidden = '<input type="hidden" name="nouvelle_tache" />';

$select_options_categories = '';
/* Fin - EDIT */

function make_input_importance($current_importance) # EDIT
{
	$text = '';
	$importance_equals_default = ($current_importance == MIN_IMPORTANCE_TASKS);
	$importance = MIN_IMPORTANCE_TASKS;
	while ($importance <= MAX_IMPORTANCE_TASKS) {
		$checked = '';
		if ($importance === $current_importance) # EDIT to default check depending on POST importance value
		{
			$checked = 'checked';
		}
		$text .= '<img src="img/im' . str_repeat("p", $importance) . '.png" alt="' . str_repeat('très', $importance - 1) . ' important"/> <input id="importance" type="radio" name="importance" value="' . $importance . '" ' . $checked . '/> ';
		$importance++;
	}
	return $text;
}

function array_checked_importance($actual_importance)
{
	$check_importance = [];
	$importance = MIN_IMPORTANCE_TASKS;
	while ($importance <= MAX_IMPORTANCE_TASKS) {
		$checked = '';
		if ($importance === $actual_importance) # EDIT to default check depending on POST importance value
		{
			$checked = 'checked';
		}
		$check_importance[] = $checked;
		$importance++;
	}
	return $check_importance;
}

function select_row_tache($id)
{
	$pdo = monSQL::getPdo();
	$query = 'SELECT * FROM taches WHERE id = ? AND id_membre = ?';
	$statement = $pdo->prepare($query);
	$statement->execute([$id, $_SESSION['id']]);
	return $statement->fetch(PDO::FETCH_ASSOC);
}

function format_insert_post()
{
	$_POST['d_rappel_tache'] = substr($_POST['d_rappel_tache'], 0, 10); # EDIT
	$_POST['date_tache'] = substr($_POST['date_tache'], 0, 10); # EDIT
}

function insert_form_not_specified()
{
	return !array_key_exists('id_categorie', $_POST)
		or !array_key_exists('nom_tache', $_POST)
		or !array_key_exists('date_tache', $_POST)
		or !array_key_exists('id_categorie', $_POST);
}

function create_form_is_empty()
{
	$_POST = array_map('trim', $_POST);

	return empty($_POST['nom_tache'])
		or empty($_POST['date_tache'])
		or empty($_POST['id_categorie'])
		or empty($_POST['d_rappel_tache']);
}

function category_dont_exist()
{
	$pdo = monSQL::getPdo();
	$sql = 'SELECT COUNT(*) FROM categories'
		.  ' WHERE categories.id =  ? AND id_membre = ?';
	$statement = $pdo->prepare($sql);
	$statement->execute([$_POST['id_categorie'], $_SESSION['id']]);
	$number_categories = $statement->fetchColumn();
	return ($number_categories !== 1);
}

function category_id_empty()
{
	if (!isset($_GET['id_categorie']))
		return true;

	$pdo = monSQL::getPdo();
	$sql = 'SELECT COUNT(*) FROM taches WHERE id_categorie =  ? AND id_membre = ?';

	$statement = $pdo->prepare($sql);
	$statement->execute([$_GET['id_categorie'], $_SESSION['id']]);

	$number_categories = $statement->fetchColumn();
	return ($number_categories === 0);
}

function tache_exists($id)
{
	$pdo = monSQL::getPdo();
	$sql = 'SELECT COUNT(*) FROM taches
	WHERE taches.id =  ? AND id_membre = ?';
	$statement = $pdo->prepare($sql);
	$statement->execute([$id, $_SESSION['id']]);
	$number_categories = $statement->fetchColumn();
	return ($number_categories == 1);
}

function complete_status($id_tache)
{
	$pdo = monSQL::getPdo();
	$sql = 'SELECT complete FROM taches WHERE id = ' . $id_tache;
	$res = $pdo->query($sql);
	$complete = $res->fetchAll();
	return $complete[0]['complete'];
}

function double_already_exists($is_old_task_edition)
{
	$pdo = monSQL::getPdo();
	$tache_id_clause = '';
	$sql_bind = [$_POST['id_categorie'], $_POST['nom_tache']];
	if ($is_old_task_edition) {
		$sql_bind = array_merge($sql_bind, [$_GET['editer']]);
		$tache_id_clause = 'AND taches.id != ?';
	}
	$sql = 'SELECT COUNT(*) FROM taches 
	WHERE taches.id_categorie = ? AND taches.nom_tache = ? ' . $tache_id_clause;

	$statement = $pdo->prepare($sql);
	$statement->execute($sql_bind);

	$number_double_taches = $statement->fetchColumn();

	return ($number_double_taches > 0);
}

function form_not_specified()
{
	return !isset($_POST['id_categorie']) or !isset($_POST['nom_tache']);
}

function double_does_exist()
{
	$pdo = monSQL::getPdo();
	$sql = 'SELECT COUNT(*) FROM taches WHERE taches.id != ?'
		. ' AND taches.id_categorie = ?'
		. ' AND taches.nom_tache = ?';
	$statement = $pdo->prepare($sql);
	$statement->execute([$_GET['editer'], $_POST['id_categorie'], $_POST['nom_tache']]);

	$nb_double_taches = $statement->fetchColumn();
	return ($nb_double_taches == 0);
}


function date_or_remind_are_invalid()
{
	if (
		!preg_match(REGEX_VALID_TASKDATE, $_POST['d_rappel_tache'])
		or !preg_match(REGEX_VALID_TASKDATE, $_POST['date_tache'])
	)
		return true;
	return false;
}

function insert_data_task()
{
	$pdo = monSQL::getPdo();
	$sql = 'INSERT INTO taches
	(id, id_membre, id_categorie, nom_tache, description, date, rappel, importance) 
	VALUES (?,?,?,?,?,?,?,?)';

	$statement = $pdo->prepare($sql);
	$statement->execute([
		NULL, $_SESSION['id'],
		$_POST['id_categorie'], $_POST['nom_tache'],
		$_POST['description'], $_POST['date_tache'],
		$_POST['d_rappel_tache'], $_POST['importance']
	]); # EDIT
	return 'Nouvelle tâche envoyée avec succès';
}

function task_dosent_exist()
{

	if (!isset($_GET['editer']))
		return false;

	$pdo = monSQL::getPdo();
	$query = 'SELECT COUNT(*) FROM taches 
	WHERE id = ? AND id_membre = ?';
	$statement = $pdo->prepare($query);

	$statement->execute([intval($_GET['editer']), $_SESSION['id']]);
	$number_double = $statement->fetchColumn();
	return ($number_double === 0);
}

function task_exists()
{
	return !task_dosent_exist();
}

function category_doesnt_exist()
{
	if (!isset($_POST['id_categorie']))
		return false;
	$pdo = monSQL::getPdo();
	$query = 'SELECT COUNT(*) FROM categories WHERE id = ?';
	$statement = $pdo->prepare($query);
	$statement->execute([$_POST['id_categorie']]);
	$number_double = $statement->fetchColumn();
	return ($number_double == 0);
}

function set_default_values()
{
	$_POST['complete'] = !isset($_POST['complete']) ?  TASK_NOT_COMPLETED : $_POST['complete'];

	$valid_post_importance = isset($_POST['importance']) and in_array($_POST['importance'], range(1, 3)); # EDIT
	$_POST['importance'] = $valid_post_importance ? $_POST['importance'] : MIN_IMPORTANCE_TASKS;
}


function insert_new_task()
{
	format_insert_post();

	if (insert_form_not_specified())
		return 'Le formulaire est mal spécifié.';
	if (create_form_is_empty())
		return 'Vous n\'avez pas rempli le formulaire.';
	if (date_or_remind_are_invalid())
		return 'La date entrée est dans un format incorrect.<br />';
	if (category_dont_exist())
		return "La catégorie de la tâche est mal spéciifé.";
	if (double_already_exists(false))
		return 'Une tâche a déjà un nom identique à ce que vous voulez créer dans la catégorie courante.';

	set_default_values();
	insert_data_task();
}

function check_update_tache()
{
	$pdo = monSQL::getPdo();
	if (task_dosent_exist())
		return 'La tâche à éditer n\'existe pas.';
	if (category_doesnt_exist())
		return 'La catégorie de la tâche à éditer n\'existe pas.';
	if (double_already_exists(true)) # EDIT 
		return 'Un doubleon de cette t$ache existe déjà dans la catégorie à éditer.';
	format_insert_post();
	if (date_or_remind_are_invalid())
		return 'La date entrée est dans un format incorrect.<br />';
	set_default_values();
	return false;
}

function update_tache()
{
	$pdo = monSQL::getPdo();
	$sql = 'UPDATE taches
	SET id_categorie = ?, nom_tache = ?, description = ?,  date = ?,
	importance = ?, complete = ?, rappel = ? 
	WHERE id = ? AND id_membre = ?';
	$statement = $pdo->prepare($sql);
	$statement->execute(
		[ # EDIT
			$_POST['id_categorie'],
			$_POST['nom_tache'],
			$_POST['description'],
			$_POST['date_tache'],
			$_POST['importance'],
			$_POST['complete'],
			$_POST['d_rappel_tache'],
			$_GET['editer'],
			$_SESSION['id']
		]
	);
	$_POST['nom_tache'] = htmlentities($_POST['nom_tache']);
	return "Tâche {$_POST['nom_tache']} modifiée avec succès";
}

function update_status($num)
{
	$pdo = monSQL::getPdo();
	if (task_dosent_exist())
		return 'La tâche à modifier n\'existe pas.';

	$sql = 'UPDATE taches SET complete = ABS(complete-1) WHERE id = ?';
	$statement = $pdo->prepare($sql);
	$statement->execute([$num]);
	return 'Le status de la tâche a été modifié avec succès.';
}


function delete_tache($id)
{
	$pdo = monSQL::getPdo();
	if (task_dosent_exist($id))
		return 'La tâche à supprimer n\'eixste pas.';

	$sql = "DELETE FROM taches WHERE id = ? AND id_membre = ?";
	$statement = $pdo->prepare($sql);
	$statement->execute([$_GET['supprimer'], $_SESSION['id']]);
	return 'La tâche avec le nom a été supprimé.';
}

function make_categories_list($int_selected_category = '')
{
	$pdo = monSQL::getPdo();
	$sql = "SELECT id, categorie FROM categories WHERE id_membre = ?";
	$statement = $pdo->prepare($sql);
	$statement->execute([$_SESSION['id']]);

	$texte_options = '';
	$selected = '';

	while ($row = $statement->fetch()) {
		if (isset($_GET['id_categorie']) and intval($_GET['id_categorie']) === $row['id']) {
			$selected = 'selected';
		}

		$texte_options .=
			' <option value="' . intval($row['id']) . '" ' .
			$selected . '>' . $row['categorie'] . '</option>';
	} # MVC
	return $texte_options;
}

function no_cat_exist($id_task)
{
	$pdo = monSQL::getPdo();
	$statement_bis = $pdo->prepare('SELECT id FROM categories WHERE id_membre = ?');
	$statement_bis->execute([$_SESSION['id']]);
	$nb_cat = $statement_bis->rowCount();
	return ($nb_cat === 0);
}


function html_options_categories_list() # MVC + EDIT ??
{
	$array_options = [];
	$pdo = monSQL::getPdo();

	if (no_cat_exist($_GET['id_categorie']))
		return '';

	$sql  = 'SELECT id, categorie FROM categories WHERE id_membre = ?';
	$statement = $pdo->prepare($sql);
	$statement->execute([$_SESSION['id']]);

	while ($row = $statement->fetch()) {
		$checked = intval($_GET['id_categorie']) === $row['id'] ? 'selected' : '';
		$array_options[] = [
			'id' => $row['id'],
			'text' => htmlentities($row['categorie']),
			'checked' => $checked
		];
	}
	return $array_options;
}

function select_tasks_of_category() # EDIT (MVC) + EMERGENCY
{
	$pdo = monSQL::getPdo();

	$sql = 'SELECT id, nom_tache, description, 
	date, id_categorie, importance 
	FROM taches WHERE id_categorie = ?';

	$statement = $pdo->prepare($sql);
	$statement->execute([$_GET['id_categorie']]);

	return $statement->fetchAll();
}
