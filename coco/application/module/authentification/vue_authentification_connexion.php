        <h2>Connexion</h2>
        <form method="post">            
            <div class='form-group'>
                <label for='uti_email'>Email</label>
                <input id='uti_email' name='uti_email' type='text' size='50' value='<?= mhe($uti_email) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='uti_mdp'>Mot de passe</label>
                <input id='uti_mdp' name='uti_mdp' type='password' size='50' value='' class='form-control' />
            </div>            
            <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
        </form>