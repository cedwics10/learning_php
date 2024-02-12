<?php 
require_once('includes/base.php');
require_once('includes/include_taches.php');
require_once('includes/head.html');
?>

<h1 style="text-align: center;">Créer et gérer vos tâches à faire</h1>
<h2 style="text-align: center;"><?=$texte_ht?></h2></br>
<form method="get" action="<?=$action?>">
<?php echo $texte_nom_cat ?> 
<select name="id_categorie" id="id_categorie" onChange="this.parentNode.submit()">
		<option value="">Séléctionner une autre catégorie</option>
		<?php echo $options_categories; ?>
	</select>
</form>
<?=$desc_categories?>
<hr />
<form action="taches.php<?=$get_link?>" method="post">
	<table>
		<tr>
			<td><b><?=$action_formulaire?></b></td><td></td>
		</tr>

		<tr>
			<td>Nom de la tâche</td>
			<td><input type="text" name="nom_tache" value="<?=$nom_tache?>"/></td>
		</tr>
		<tr>
			<td>Jour de la réalisation de la tâche</td>
			<td><input type="date" name="date_tache" value="<?=$date_tache?>"/></td>
		</tr>
		<tr>
			<td>Date rappel de la réalisation de la tâche (optioneel <input type="checkbox" name="date_rappel_ok"/> ):</td>
			<td><input type="date" name="d_rappel_tache" value="<?=$d_rappel_tache?>"/></td>
		</tr>
		<tr>
			<td>Catégorie de la tâche</td>
			<td>
				<select name="id_categorie" id="id_categorie">
						<option value="">Séléctionner une autre catégorie</option>
						<?php echo $options_categories; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Description de la tâche</td>
			<td><textarea id="description" name="description"><?=htmlentities($description)?></textarea></td>
		</tr>
		<tr>
			<td>Terminé ?</td>
			<td><input type="checkbox" name="complete" value="1" <?=$complete?>></td>
		</tr>
		<tr>
			<td>
				<?=$input_hidden?>
				<input type="submit" name="envoyer" />
			</td>
			<td>
			</td>
		</tr>
	</table>
</form>
<hr /></br>
Revenir à l'accueil : <a href="index.php" label="Retour à l'accueil">cliquez-ici</a>
<?php 
require_once('includes/footer.html');
?>