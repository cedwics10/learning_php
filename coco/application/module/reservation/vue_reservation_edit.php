    <form method="post" action="<?= hlien("reservation", "save") ?>">
        <input type="hidden" name="res_id" id="res_id" value="<?= $id ?>" />

        <div class='form-group'>
            <label for='res_date_creation'>Date_creation</label>
            <input id='res_date_creation' name='res_date_creation' type='text' size='50' value='<?= mhe($res_date_creation) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='res_date_debut'>Date_debut</label>
            <input id='res_date_debut' name='res_date_debut' type='text' size='50' value='<?= mhe($res_date_debut) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='res_date_fin'>Date_fin</label>
            <input id='res_date_fin' name='res_date_fin' type='text' size='50' value='<?= mhe($res_date_fin) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='res_nbposte'>Nbposte</label>
            <input id='res_nbposte' name='res_nbposte' type='text' size='50' value='<?= mhe($res_nbposte) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='res_utilisateur'>Utilisateur</label>
            <input id='res_utilisateur' name='res_utilisateur' type='text' size='50' value='<?= mhe($res_utilisateur) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='res_espace'>Espace</label>
            <input id='res_espace' name='res_espace' type='text' size='50' value='<?= mhe($res_espace) ?>' class='form-control' />
        </div>
        <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
    </form>