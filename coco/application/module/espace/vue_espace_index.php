<h2>Liste des espaces</h2>
<?php if (isset($_SESSION['uti_profil'])  and $_SESSION['uti_profil'] == 'admin') { ?>
	<p><a class="btn btn-primary" href="<?= hlien("espace", "edit", "id", 0) ?>">Nouveau espace</a></p>
<?php } ?>
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Nom</th>
			<th>Description</th>
			<th>Adresse</th>
			<th>NB poste</th>
			<th>Prix</th>
			<?php if (isset($_SESSION['uti_profil']) and $_SESSION['uti_profil'] != 'admin') { ?>
				<th>Modifier</th>
				<th>Supprimer</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($data as $row) { ?>
			<tr>

				<td><?= mhe($row['esp_id']) ?></td>
				<td><?= mhe($row['esp_nom']) ?></td>
				<td><?= nl2br(mhe($row['esp_description'])) ?></td>
				<td><?= mhe($row['esp_adresse']) ?></td>
				<td><?= mhe($row['esp_nbposte']) ?></td>
				<td><?= mhe($row['esp_prix']) ?>€</td>
				<?php if (isset($_SESSION['uti_profil']) and $_SESSION['uti_profil'] == 'admin') { ?>
					<td><a class="btn btn-warning" href="<?= hlien("espace", "edit", "id", $row["esp_id"]) ?>">Modifier</a></td>
					<td><a class="btn btn-danger" href="<?= hlien("espace", "delete", "id", $row["esp_id"]) ?>">Supprimer</a></td>
				<?php } ?>
			</tr>
		<?php } ?>
	</tbody>
</table>