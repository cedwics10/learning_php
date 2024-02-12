<?php
require_once('../includes/php/include_base.php');
require_once('../includes/php/include_connexion.php');
require_once('../includes/html/include_head.html');
require_once('../includes/html/include_header.html');
?>
<h1>Connexion</h1>
<h3 id="erreur"><?=$error_message?></h3>
<?php if ($show_form) { ?>
<form method="post" action="connexion.php#erreur">
    <label for="pseudo">Pseudo :</label> <input type="text" name="pseudo" value="<?=$pseudo;?>"><br />
    <label for="mot_de_passe">Mot de passe :</label> <input type="password" name="mot_de_passe"><br />
    <input type="submit" name="btsubmit" value="Envoyer" />
</form>
<?php
}
require_once('../includes/html/include_footer.php');
?>