<?php
if (connecte()) {
    header('Location: index.php');
    exit();
}

$pseudo = '';
$error_message = '';
$value = '';

$show_form = true;

function not_filled_form()
{
    return empty(trim($_POST['pseudo'])) or empty(trim($_POST['mot_de_passe'])) or empty(trim($_POST['c_mot_de_passe']));
}

function length_pseudo_not_ok()
{
    return mb_strlen($_POST['pseudo']) < MIN_L_PSEUDO or mb_strlen($_POST['pseudo']) > MAX_L_PSEUDO;
}

function length_password_not_ok()
{
    return mb_strlen($_POST['mot_de_passe']) < MIN_L_PASSWORD or mb_strlen($_POST['mot_de_passe']) > MAX_L_PASSWORD;
}

function pseudo_exists($pseudo)
{
    $pdo = monSQL::getPdo();
    $QUERY = 'SELECT id FROM membres WHERE pseudo = ?';
    $statement = $pdo->prepare($QUERY);
    $statement->execute([$pseudo]);
    $number_double = $statement->rowCount();
    if ($number_double == 1)
        return true;
    return false;
}

function pseudo_not_conform()
{
    return !ctype_alnum($_POST['pseudo']);
}

function password_confirmation_dont_match()
{
    return $_POST['c_mot_de_passe'] !== $_POST['mot_de_passe'];
}

function upload_avatar()
{
    if (empty($_FILES['avatar']['tmp_name']))
        return false;
    if (!is_uploaded_file($_FILES['avatar']['tmp_name']))
        return false;

    $member_avatar_link = 'avatars/' . changebasename($_FILES['avatar']['name'], $_POST['pseudo']);
    move_uploaded_file($_FILES['avatar']['tmp_name'], $member_avatar_link);
}

function register_member()
{
    $pdo = monSQL::getPdo();
    $member_pseudo = $_POST['pseudo'];
    $member_password = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $member_avatar_link = '';

    upload_avatar();

    $query_is_pseudo_exists = 'INSERT INTO membres (id,pseudo,mdp,photo,role) VALUES (?,?,?,?,?);';
    $statement = $pdo->prepare($query_is_pseudo_exists);
    $statement->execute(['', $member_pseudo, $member_password, $member_avatar_link, IS_A_MEMBER]);
    return false;
}

function error_inscription_form()
{
    $pdo = monSQL::getPdo();
    if (not_filled_form())
        return 'Vous n\'avez pas spécifié votre pseudo ou votre mot de passe.';
    if (length_pseudo_not_ok())
        return 'Votre pseudo doit faire entre ' . MIN_L_PSEUDO . ' et ' . MAX_L_PSEUDO . ' caractères.';
    if (length_password_not_ok())
        return 'Votre mot de passe doit faire entre ' . MIN_L_PASSWORD . ' et  ' . MAX_L_PASSWORD;
    if (pseudo_exists($_POST['pseudo']))
        return 'Votre pseudo existé déjà dans la base de données.';
    if (pseudo_not_conform())
        return 'Votre pseudo contient des caractères non-alphanumériques.';
    if (password_confirmation_dont_match())
        return 'Le mot de passe et la confirmation ne correspondent pas.';
    if (avatar_not_ok())
        return 'L\'avatar doit faire EDIT dimension etc !';
    return register_member();
}

if (isset($_SESSION['pseudo'])) // Déjà connecté !!
{
    $error_message = 'Vous êtes déjà connecté ME. ou M. ' . $_SESSION['pseudo'] . ' !!!';
    $show_form = false;
} else {
    if (isset($_POST['btsubmit'])) {
        $error_message = error_inscription_form();
        if ($error_message === false)
            header('Location: index.php?' . SUCCESSFUL_SIGNUP . '=' . SUCCESSFUL_SIGNUP);
    }
}
