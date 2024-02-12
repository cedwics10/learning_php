<?php
require_once('../includes/php/include_base.php');
require_once('../includes/php/include_taches.php');
require_once('../includes/php/logic_taches.php')
?>

<?php # HTML
require_once('../includes/html/include_head.html');
require_once('../includes/html/include_header.html');
?>

<h1>Éditer les tâches :</h1>
<h4><?= $error_message ?></h4>

<form method="get" action="">
	<?php echo $texte_nom_cat ?>
	<select name="id_categorie" id="id_categorie" onChange="this.parentNode.submit()">
		<option value="">Séléctionner une autre catégorie</option>
		<?php
		$options_category = html_options_categories_list();
		foreach ($options_category as $cateogry_data) { ?>
			<option value="<?= $cateogry_data['id']?>" <?= $cateogry_data['checked']?>><?= $cateogry_data['text'] ?></option>
		<?php } ?>
	</select>
</form>
<?php if (!category_id_empty()) { ?>
	<table>
		<tr>
			<td>ID</td>
			<td><b>Nom</b></td>
			<td>description</td>
			<td>date</td>
			<td>E</td>
			<td>X</td>
		</tr>
		<?php foreach (select_tasks_of_category() as $row) {
		?>
			<tr>
				<td class="titre_tache">
					<?=$row['id']?>
				</td>
				<td class="titre_tache">
					<?= htmlentities($row['nom_tache']) ?>
				</td>
				<td class="titre_tache">
					<?= htmlentities($row['description']) ?>
				</td>
				<td class="titre_tache">
					<?= htmlentities($row['date']) ?>
				</td>
				<td>
					<a href="taches.php?editer=<?= $row['id'] ?>&id_categorie=<?= $row['id_categorie'] ?>">E</a>
				</td>
				<td>
					<a href="taches.php?supprimer=<?= $row['id'] ?>>">X</a>
				</td>
			<?php } ?>
	</table>
<?php } ?>

<hr />
<form action="taches.php<?= $get_link ?>" method="post">
	<table>
		<tr>
			<td><b><?= $action_formulaire ?></b></td>
			<td></td>
		</tr>

		<tr>
			<td>Nom de la tâche</td>
			<td><input type="text" name="nom_tache" value="<?= htmlentities($nom_tache) ?>" /></td>
		</tr>
		<tr>
			<td>Jour de la réalisation</td>
			<td><input type="date" name="date_tache" id="date_tache" value="<?= $date_tache ?>" /></td>
		</tr>
		<tr>
			<td>Date de rappel (identique <input type="checkbox" id="ch_rappel_tache" name="ch_rappel_tache" onclick="DateRappel()" /> ) :</td>
			<td><input type="date" name="d_rappel_tache" id="d_rappel_tache" value="<?= $d_rappel_tache ?>" /></td>
		</tr>
		<tr>
			<td>Catégorie</td>
			<td>
			<select name="id_categorie" id="id_categorie" onChange="this.parentNode.submit()">
				<option value="">Séléctionner une autre catégorie</option>
				<?php
				$options_category = html_options_categories_list();
				foreach ($options_category as $cateogry_data) { ?>
					<option value="<?= $cateogry_data['id']?>" <?= $cateogry_data['checked']?>><?= $cateogry_data['text'] ?></option>
				<?php } ?>
			</select>
			</td>
		</tr>
		<tr>
			<td>Description</td>
			<td><textarea id="description" name="description"><?= htmlentities($description) ?></textarea></td>
		</tr>
		<tr>
			<td>Importance</td>
			<td>
			<?php $checked_importance = array_checked_importance($importance);?>
				<img src="img/imp.png" alt=" important"/> <input id="importance" type="radio" name="importance" value="1" <?=$checked_importance[0]?>/>
				<img src="img/impp.png" alt="très important"/> <input id="importance" type="radio" name="importance" value="2" <?=$checked_importance[1]?>/>
				<img src="img/imppp.png" alt="trèstrès important"/> <input id="importance" type="radio" name="importance" value="3" <?=$checked_importance[2]?>/>
			</td>
		</tr>
		<tr>
			<td>Terminé ?</td>
			<td><input type="checkbox" name="complete" value="1" <?= $complete ?>></td>
		</tr>
		<tr>
			<td>
				<?= $input_hidden ?>
				<input type="submit" name="envoyer" />
			</td>
			<td>
			</td>
		</tr>
	</table>
</form>
<hr />
<?php
require_once('../includes/html/include_footer.php');
?>