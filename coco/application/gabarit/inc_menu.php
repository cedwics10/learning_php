<nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</span></a>
        </li>
        <li><a class='nav-link' href='<?= hlien("espace", "index") ?>'>Espace</a></li>
        <li><a class='nav-link' href='<?= hlien("reservation", "index") ?>'>Reservation</a></li>
        <li><a class='nav-link' href='<?= hlien("utilisateur", "index") ?>'>Utilisateur</a></li>

      </ul>
      <ul class="navbar-nav ml-auto">
        <?php if (estUtilisateur()) { ?>
          <!-- <li><a class="nav-link" href="<?= hlien("authentification", "option") ?>">Option</a></li> -->
          <li><a class="nav-link" href="<?= hlien("authentification", "deconnexion") ?>"><?= mhe($_SESSION['uti_profil']) ?> - Déconnexion</a></li>
        <?php } else { ?>
          <li><a class="nav-link" href='<?= hlien("authentification", "inscription") ?>'>Inscription</a></li>
          <li><a class="nav-link" href='<?= hlien("authentification", "connexion") ?>'>Connexion</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>