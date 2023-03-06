    <form method="post" action="<?= hlien("utilisateur", "save") ?>">
        <input type="hidden" name="uti_id" id="uti_id" value="<?= $id ?>" />

        <div class='form-group'>
            <label for='uti_nom'>Nom</label>
            <input id='uti_nom' name='uti_nom' type='text' size='50' value='<?= mhe($uti_nom) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='uti_prenom'>Prenom</label>
            <input id='uti_prenom' name='uti_prenom' type='text' size='50' value='<?= mhe($uti_prenom) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='uti_email'>Email</label>
            <input id='uti_email' name='uti_email' type='text' size='50' value='<?= mhe($uti_email) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='uti_mdp'>Mdp</label>
            <input id='uti_mdp' name='uti_mdp' type='text' size='50' value='' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='uti_profil'>Profil</label>
            <textarea name='uti_profil' type='texta' size='50' rows='5' class='form-control' <?= mhe($uti_profil) ?>></textarea>
        </div>
        <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
    </form>