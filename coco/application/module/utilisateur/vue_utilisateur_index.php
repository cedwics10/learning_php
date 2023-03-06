    <h2>utilisateur</h2>
    <p><a class="btn btn-primary" href="<?= hlien("utilisateur", "edit", "id", 0) ?>">Nouveau utilisateur</a></p>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>

    			<th>Id</th>
    			<th>Nom</th>
    			<th>Prenom</th>
    			<th>Email</th>
    			<th>Profil</th>
    			<?php if (isset($_SESSION['uti_profl']) and ($_SESSION['uti_profil']) == 'admin') { ?>
    				<th>modifier</th>
    				<th>supprimer</th>
    			<?php } ?>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) { ?>
    			<tr>

    				<td><?= mhe($row['uti_id']) ?></td>
    				<td><?= mhe($row['uti_nom']) ?></td>
    				<td><?= mhe($row['uti_prenom']) ?></td>
    				<td><?= mhe($row['uti_profil']) ?></td>
    				<?php if (isset($_SESSION['uti_profl']) and $_SESSION['uti_profil'] == 'admin') { ?>
    					<td><a class="btn btn-warning" href="<?= hlien("utilisateur", "edit", "id", $row["uti_id"]) ?>">Modifier</a></td>
    					<td><a class="btn btn-danger" href="<?= hlien("utilisateur", "delete", "id", $row["uti_id"]) ?>">Supprimer</a></td>
    				<?php } ?>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>