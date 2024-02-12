<?php
$error_message = 'Vous n\'êtes pas connecté ME. ou M. Inscrivez-vous <a href="inscription.php">ici</a>.';
$value = '';

$show_form = false;

if (isset($_SESSION['id'])) # EDIT
{
    $error_message = '';
    $show_form = true;
}

function password_data_unspecified()
{
    if (
        empty($_POST['mot_de_passe'])
        and empty($_POST['n_mot_de_passe'])
        and empty($_POST['c_n_mot_de_passe'])
    )
        return true;
    return false;
}

function old_password_not_ok()
{
    return !password_verify($_POST['mot_de_passe'], $_SESSION['mdp']); # EDIT : ajouter le mot de passe dans le SESSION
}

function pseudo_size_not_ok()
{
    (mb_strlen($_POST['n_mot_de_passe']) < MIN_L_PASSWORD
        or mb_strlen($_POST['n_mot_de_passe']) > MAX_L_PASSWORD);
}

function error_form_password()
{
    if (password_data_unspecified())
        return 'Le formulaire n\'a pas été rempli côté mot de passe.';
    if (old_password_not_ok())
        return 'Le mot de passe enré n\'est pas correct.';;
    if ($_POST['n_mot_de_passe'] !== $_POST['c_n_mot_de_passe'])
        return 'Le nouveau mot de passe et sa confirmation ne correspondent pas.<br />';
    if (pseudo_size_not_ok())
        return 'Le mot de passe doit faire entre ' . MIN_L_PASSWORD . ' et ' . MAX_L_PASSWORD . ' caractères.<br />';
    return false;
}

function error_form_avatar()
{
    if (empty($_FILES['avatar']['tmp_name']))
        return 'Vous n\'avez pas spécifié de nouvel avatar. Il demeurera inchangé';

    if (!check_uploaded_avatar())
        return  'L\'avatar doit faire maximum 600*600 et les formats autoriséess sont :' . implode(',', AVATAR_EXTENSION_OK);
    return false;
}

function select_member_data()
{
    $pdo = monSQL::getPdo();
    $select_member_data = 'SELECT photo,mdp, pseudo FROM membres 
    WHERE id = (?)';
    $statement = $pdo->prepare($select_member_data);
    $statement->execute([$_SESSION['id']]);
    $donnees_membre = $statement->fetch();
    return $donnees_membre;
}

function update_photo_mdp($member_hash_mdp,  $member_avatar)
{
    $pdo = monSQL::getPdo();

    $update_member = 'UPDATE membres SET mdp = ? , photo = ? WHERE id = ?';
    $statement = $pdo->prepare($update_member);
    $statement->execute([$member_hash_mdp, $member_avatar, $_SESSION['id']]);
}

if (isset($_POST['btsubmit']) and isset($_SESSION['id'])) {
    $donnees_membre = select_member_data();
    $member_avatar = $donnees_membre['photo'];
    $member_hash_mdp = $donnees_membre['mdp'];

    $error_message_password = error_form_password();
    if ($error_message_password === false) {
        $member_hash_mdp = password_hash($_POST['n_mot_de_passe'], PASSWORD_DEFAULT);
        $error_message_password = 'Le mot de passe a bien été modifié !';
    }

    $error_message_avatar = error_form_avatar();
    if ($error_message_avatar  === false) {
        $member_avatar = 'avatars/./' . changebasename($_FILES['avatar']['name'], $_SESSION['pseudo']);

        move_uploaded_file($_FILES['avatar']['tmp_name'], $member_avatar);
        $error_message_avatar = 'L\'avatar a bien été modifié !';
    }

    $error_message = $error_message_password .
        '<br />' . $error_message_avatar;

    update_photo_mdp($member_hash_mdp,  $member_avatar);
}
