<?php
require('gabarit/header.php');
echo print_r($_SESSION);
?>

<h1>Site auto-moto - <?php
                        if (isset($_SESSION['pseudo'])) {
                            echo 'Bonjour ' . htmlentities($_SESSION['pseudo']);
                        }
                        ?> </h1>

<h2>Bienvenu sur le site d'automoto où vous pourrez louer/acheter une moto à votre convenance.</h2>

<?php if (!isset($_SESSION['pseudo'])) { ?>
    <a href="inscription.php">S'inscrire</a> - <a href="connexion.php">Se connecter</a>
<?php } else {
    echo '<a href="deconnexion.php">Se déconnecter</a>';
}
?>

<?php
require('gabarit/footer.php')
?>