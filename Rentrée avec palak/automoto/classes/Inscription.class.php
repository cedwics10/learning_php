<?php
class Inscription
{
    const TYPE_VEHICULE = ['auto', 'moto'];

    const MIN_LENGTH_MDP = 8;
    const MAX_LENGTH_MDP = 15;

    private string $pseudo;
    private string $mdp;

    private PDO $sql;

    public function __construct(PDO $pdo)
    {
        $this->sql = $pdo;

        if (!isset($_POST['bt_submit']))
            return false;

        $this->pseudo = $_POST['pseudo'] ?? null;
        $this->mdp = $_POST['mdp'] ?? null;
    }

    private function noFormSent()
    {
        return !isset($_POST['bt_submit']);
    }

    private function emptyPseudo()
    {
        return empty($this->pseudo);
    }

    private function invalidPseudo()
    {
        return empty($this->pseudo);
    }

    private function pseudoAlreadyExists()
    {
        $statement = $this->sql->prepare('SELECT COUNT(*) FROM membres WHERE pseudo = :pseudo');
        $statement->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);

        $statement->execute();
        $data = $statement->fetchColumn();

        return ((int) $data == 1);
    }

    private function invalidPassword()
    {
        return !preg_match("#^[.a-z0-9_-]{8,15}$#i", $this->mdp);
    }

    private function invalidType()
    {
        return !isset($_POST['type']) or !in_array($_POST['type'], self::TYPE_VEHICULE);
    }

    private function registerMember()
    {
        $statement = $this->sql->prepare('INSERT INTO membres(id, pseudo, mdp)  VALUES (NULL, :pseudo, :mdp)');

        $statement->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);

        $this->mdp = password_hash($this->mdp, PASSWORD_DEFAULT);
        $statement->bindValue(':mdp', $this->mdp, PDO::PARAM_STR);

        $statement->execute();

        echo 'Bravo ' . htmlentities($_POST['pseudo']) . ' <a href="index.php">Retour au menu principal.</a>';
        exit();
    }

    public function checkData()
    {
        if ($this->noFormSent()) return 'Veuillez vous inscrire.';
        if ($this->emptyPseudo()) return 'Le pseudo n\'existe pas.';
        if ($this->invalidPseudo()) return 'Le pseudo est invalide.';
        if ($this->pseudoAlreadyExists()) return 'Le pseudo existe déjà.';
        if (!isset($this->mdp)) return 'Le mot de passe n\'existe pas.';
        if ($this->invalidPassword()) return 'Le mot de passe doit faire entre ' . self::MIN_LENGTH_MDP
            . ' et ' . self::MAX_LENGTH_MDP . ' caractères.';

        return $this->registerMember();
    }
}
