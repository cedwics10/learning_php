<?php 
require_once('includes/base.php');
require_once('includes/include_index.php');
require_once('includes/head.html');
?>
<h1 style="text-align:center;">To-do list : liste des tâches</h1></br>
<hr />
Liste des catégories :
<table>
<tr>
    <td>ID</td>
    <td>Nom</td>
    <td>tâches</td>
</tr>
<?=$liste_categorie?>
<tr>
    <td></td>
    <td>=></td>
    <td><a href="index.php">INDEX</a></td>
</tr>
</table>
<hr />
Tâches - ordinner par : 
<a href='<?=qmark_part(['order_by'], 'order_by=categorie')?>'>Categorie</a>, 
<a href='<?=qmark_part(['order_by'], 'order_by=date')?>'>Date</a>, 
Importance, 
<a href='<?=qmark_part(['order_by'], 'order_by=nom')?>'>Nom</a>, </br>
<table>
<tr>
    <td>ID</td>
    <td class="titre_tache">Nom tâche</td>
	<td>Catégorie</td>
    <td>Description</td>
    <td>Date</td>
</tr>


<?php
echo taches_date($pdo);
?>
</table>

</br>
</br>
<a href="categories.php"> Créer de nouvelles catégories</a> - <a href="taches.php"> Créer de nouvelles tâches</a>
<?php 
require_once('includes/footer.html');
?>