<?php
require_once('../includes/php/include_base.php');
require_once('../includes/php/include_inscription.php');
require_once('../includes/html/include_head.html');
require_once('../includes/html/include_header.html');
?>
<h1>Inscription</h1>
<h3 id="erreur"><?=$error_message?></h3>
<?php if ($show_form) { ?>
<form method="post" action="inscription.php#erreur" enctype="multipart/form-data">
    <table>
        <tr>
            <td>
                <label for="pseudo">Pseudo :</label>
            </td>
            <td>
                <input type="text" name="pseudo" value="<?=$pseudo;?>">
            </td>
        </tr>
        <tr>
            <td>
                <label for="mot_de_passe">Mot de passe :</label>
            </td>
            <td>
                 <input type="password" name="mot_de_passe"><br />
            </td>
        </tr>
        <tr>
            <td>
                <label for="c_mot_de_passe">Confirmer le mot de passe :</label>
            </td>
            <td>
                <input type="password" name="c_mot_de_passe"><br />
            </td>
        </tr>
        <tr>
            <td>
                 <label for="avatar">Choisir un avatar :</label> 
            </td>
            <td>
            <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" title="<?=$value?>"> <?=$value?><br />
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <input type="submit" name="btsubmit" value="Envoyer" />
            </td>
        </tr>
    </table>
     <br />
     
     
   
</form>
<?php
}
require_once('../includes/html/include_footer.php');
?>