<?php
require_once('../includes/php/include_base.php');
require_once('../includes/php/include_options.php');
require_once('../includes/html/include_head.html');
require_once('../includes/html/include_header.html');
?>
<h1>Page d'options</h1>
<h3 id="erreur"><?=$error_message?></h3>

La page d'option permet d'éditer l'ensemble vos paramètres, c'est-à-dire les données vous permettrant de configurer votre accès personnalisé au compte.<br />
<?php if($show_form) { ?>
<form method="post" action="options.php" enctype="multipart/form-data">
<table>
		<tr>
			<td><label for="mot_de_passe">Ancien mot de passe :</label></td>
			<td><input type="password" name="mot_de_passe"></td>
        </tr>
        <tr>
			<td><label for="n_mot_de_passe">Nouveau mot de passe :</label></td>
			<td><input type="password" name="n_mot_de_passe"></td>
        </tr>
        <tr>
			<td><label for="c_n_mot_de_passe">Confirmation :</label></td>
			<td><input type="password" name="c_n_mot_de_passe"></td>
        </tr>
        <tr>
			<td><label for="avatar">Nouvel avatar :</label></td>
			<td><input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg"> <?=$value?></td>
        </tr>

        <tr>
			<td></td>
			<td><input type="submit" name="btsubmit" value="Envoyer" /></td>
        </tr>
    
</form>
<?php
}
require_once('../includes/html/include_footer.php');
?>