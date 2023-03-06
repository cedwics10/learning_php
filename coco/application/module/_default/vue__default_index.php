<h1>Mode d'emploi</h1>
<ol>
    <li>Copier l'ensemble des fichiers du Framework dans un nouveau répertoire projet.</li>
    <li>Editer "_include/inc_config.php" pour configurer l'accès la base de données. <b>Bien préciser la longueur du préfixe des nom de champs (généralement 3 caractères).<b></li>
    <li><a class="btn btn-success" href="<?= hlien("_generateur", "index") ?>">Exécuter le générateur </a> : il va générer :
        <ul>
            <li>Pour chaque table de la base de données, une classe héritée de Entity.</li>
            <li>Pour chaque table de la base de données, un module composé de :</li>
            <ul>
                <li>un controleur hérité de Ctr_controleur</li>
                <li>une vue "index"</li>
                <li>une vue "edit"</li>
            </ul>
            <li>
                le fichier de menu "_include/inc_menu.php".
            </li>
        </ul>
    </li>
    <li>Supprimer le générateur (pour éviter de le redéclencher par mégarde !) : supprimer le répertoire "_module/_generateur/".</li>
</ol>