<?php
require_once('../includes/php/include_base.php');
require_once('../includes/php/include_index.php');
require_once('../includes/php/include_categories.php');
require_once('../includes/html/include_head.html');
require_once('../includes/html/include_header.html');
?>

<table class="bloc_infos">
	<h1>Liste des catégories déjà créées :</h1>
	<tr>
		<td>ID</td>
		<td>Titre</td>
		<td>Nb tâches</td>
		<td>X</td>
		<td>E</td>
	</tr>
	<?php
	$category_results = rows_categories();
	while ($row = $category_results->fetch()) { ?>
		<tr>
			<td><?= $row['id'] ?></td>
			<td class='titre_tache'><?= htmlentities($row['categorie']) ?></td>
			<td class=''><?= $row['nbTaches'] ?></td>
			<td><a href="categories.php?delete_id=<?= $row['id'] ?>">X</a></td>
			<td><a href="categories.php?editer=<?= $row['id'] ?>">E</a></td>
		</tr>
	<?php
	}
	?>
</table>
<hr />
<?php echo $form_usage; ?> une catégorie :
<form action="categories.php?<?= $editer_url ?>" method="post">
	<input type="text" name="category<?= $editer ?>" value="<?= htmlentities($f_category) ?>" />

	<?= $hidden ?>
	<input type="submit">
	<p><?= $message_user ?></p>
</form>
<hr />
<?php
require_once('../includes/html/include_footer.php');
?>