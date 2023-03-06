    <form method="post" action="<?= hlien("espace", "save") ?>">
        <input type="hidden" name="esp_id" id="esp_id" value="<?= $id ?>" />

        <div class='form-group'>
            <label for='esp_nom'>Nom</label>
            <input id='esp_nom' name='esp_nom' type='text' size='50' value='<?= mhe($esp_nom) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='esp_description'>Description</label>
            <input id='esp_description' name='esp_description' type='text' size='50' value='<?= mhe($esp_description) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='esp_adresse'>Adresse</label>
            <input id='esp_adresse' name='esp_adresse' type='text' size='50' value='<?= mhe($esp_adresse) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='esp_nbposte'>Nbposte</label>
            <input id='esp_nbposte' name='esp_nbposte' type='text' size='50' value='<?= mhe($esp_nbposte) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='esp_prix'>Prix</label>
            <input id='esp_prix' name='esp_prix' type='text' size='50' value='<?= mhe($esp_prix) ?>' class='form-control' />
        </div>
        <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
    </form>