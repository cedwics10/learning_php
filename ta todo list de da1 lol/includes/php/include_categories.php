<?php
if (!connecte()) {
	header('Location: index.php');
	exit();
}

$editer = '';
$editer_url = '';
$message_user = '';

$form_usage = 'Créer';
$cat_editer = '';

$f_category = '';
$edit = '';
$hidden = '';

function category_length_not_ok($categorie_name)
{
	if ((strlen($categorie_name) < MIN_LENGTH_CATEGORY_NAME) or (strlen($categorie_name) < MIN_LENGTH_CATEGORY_NAME))
		return true;
	return false;
}

function not_members_category()
{
	$pdo = monSQL::getPdo();
	$sql = 'SELECT categorie, id_membre FROM categories WHERE id = ? AND id_membre = ?';
	$statement = $pdo->prepare($sql);
	$statement->execute([$_GET['editer'], $_SESSION['id']]);
	$data_member = $statement->fetchAll();
	return (count($data_member) === 0);
}


function update_category_name()
{
	$pdo = monSQL::getPdo();
	if (!isset($_GET['editer']) or !isset($_POST['category_editer'])) {
		return 'Le formulaire est mal spécifié.';
	}

	$sql = 'SELECT categorie, id_membre FROM categories 
	WHERE id = ? AND categorie = ? AND id_membre = ?';
	$statement = $pdo->prepare($sql);
	$statement->execute([$_GET['editer'], $_POST['category_editer'], $_SESSION['id']]);
	$number_of_categories = $statement->rowCount();

	if ($number_of_categories !== 0)
		return 'Cette catégorie existe déjà.';

	if (not_members_category($statement))
		return 'une erreur imprévue est arrivée';

	if (category_length_not_ok($_POST['category_editer'])) {
		return 'La longueur du titre de la catégorie doit être compris entre 3 et 100 caractères';
	}

	$sql = 'UPDATE categories SET categorie = ? 
	WHERE id = ? AND id_membre = ?';
	$statement = $pdo->prepare($sql);
	$statement->execute(
		[
			$_POST['category_editer'],
			$_GET['editer'],
			$_SESSION['id']
		]
	);

	return '';
}


function double_category_exists($categorie)
{
	$pdo = monSQL::getPdo(); # EDIT
	$message_user = '';
	$sql = 'SELECT COUNT(*) FROM categories 
	WHERE categories.categorie = "' . $categorie . '"';
	$res = $pdo->query($sql);
	$number_of_double = $res->fetchColumn();
	return ($number_of_double > 0);
}

function create_new_cateogry($categorie)
{
	$pdo = monSQL::getPdo();
	if (double_category_exists($categorie))
		return  '<b>Cette catégorie a déjà été créée !</b>';

	if (category_length_not_ok($categorie))  # edit
		return  '<b>Le nom que vous avez choisi est trop court</b>';

	$sql = 'INSERT INTO categories (categorie, id_membre) 
	VALUES (?,?)';
	$statement = $pdo->prepare($sql);
	$statement->execute([$categorie, $_SESSION['id']]);
	return "<b>La catégorie au nom de $categorie a été créé</b>";
}

function delete_from_category_tasks($id)
{
	if (!isset($_SESSION['id']))
		return false;

	$pdo = monSQL::getPdo(); # EDITER

	$sql = 'DELETE FROM taches WHERE id_categorie = ? AND id_membre = ?';
	$statement = $pdo->prepare($sql);
	$statement->execute([$id, $_SESSION['id']]);

	/* EDIT */
	$sql = 'DELETE FROM categories WHERE id = ?';
	$statement = $pdo->prepare($sql);
	$statement->execute([$id]);

	return '<b>La catégorie a été supprimée avec succès.</b>';
}

function delete_category($id)
{
	$pdo = monSQL::getPdo();
	$sql = 'SELECT COUNT(*) FROM categories WHERE categories.id = ? AND categories.id_membre = ?';
	$statement = $pdo->prepare($sql);
	$statement->execute([$id, $_SESSION['id']]);

	$number_of_match = $statement->fetchColumn();
	if ($number_of_match !== 1) {
		return '<b>La catégorie que vous voulez effacer n\'existe pas</b>'; # texte
	}

	delete_from_category_tasks($id);
}

function rows_categories()
{
	$pdo = monSQL::getPdo();
	$result_exists = false; # EDIT
	$sql = 'SELECT categories.id, categories.categorie, COUNT(taches.id)'
		. ' `nbTaches` FROM categories'
		. ' LEFT JOIN taches ON taches.id_categorie = categories.id'
		. ' LEFT JOIN membres ON membres.id = categories.id_membre'
		. ' WHERE membres.id = ?'
		. ' GROUP BY categories.id';
	$statement = $pdo->prepare($sql);
	$statement->execute([$_SESSION['id']]);
	return $statement;

	if (!$result_exists) {
		echo "Aucune catégorie n'existe.";
		return false;
	}
}

if (isset($_POST['edit_category'])) {
	$message_user = update_category_name();
}

if (isset($_GET['editer'])) {
	$pdo = monSQL::getPdo();
	$editer = '_editer';
	$sql = 'SELECT categorie FROM categories 
	WHERE id = ? AND id_membre = ?';
	$statement = $pdo->prepare($sql);
	$statement->execute([$_GET['editer'], $_SESSION['id']]);
	$number_of_categories = $statement->rowCount();

	if ($number_of_categories === 1) {
		$form_usage = 'Editer';
		$editer_url = 'editer=' . $_GET['editer'];
		$f_category = $statement->fetchColumn();
		$hidden = '<input type="hidden" name="edit_category"/>';
	}
}

if (isset($_POST['category'])) {
	$message_user = create_new_cateogry($_POST['category']);
} else if (isset($_GET['delete_id'])) {
	$message_user = delete_category($_GET['delete_id']);
}
