    <h2>Réserver un espace</h2>
    <p><a class="btn btn-primary" href="<?= hlien("reservation", "edit", "id", 0) ?>">Nouveau reservation</a></p>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>

    			<th>Id</th>
    			<th>Date_creation</th>
    			<th>Date de debut</th>
    			<th>Date de fin</th>
    			<th>Nombre de postes</th>
    			<th>Utilisateur</th>
    			<th>Espace</th>
    			<?php if (true) { ?>
    				<th>modifier</th>
    				<th>supprimer</th>
    			<?php } ?>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) { ?>
    			<tr>

    				<td><?= mhe($row['res_id']) ?></td>
    				<td><?= mhe($row['res_date_creation']) ?></td>
    				<td><?= mhe($row['res_date_debut']) ?></td>
    				<td><?= mhe($row['res_date_fin']) ?></td>
    				<td><?= mhe($row['res_nbposte']) ?></td>
    				<td><?= mhe($row['uti_nc']) ?></td>
    				<td><?= mhe($row['esp_nom']) ?></td>
    				<td><a class="btn btn-warning" href="<?= hlien("reservation", "edit", "id", $row["res_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("reservation", "delete", "id", $row["res_id"]) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>