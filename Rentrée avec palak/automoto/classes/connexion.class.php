<?php
class Connexion
{
    const MIN_LENGTH_MDP = 8;
    const MAX_LENGTH_MDP = 15;

    private string $pseudo;
    private string $mdp;

    private PDO $sql;

    private string $erreurConnexion = 'Le pseudo ou mot de passe est incorrect.';

    public function __construct(PDO $pdo)
    {
        $this->sql = $pdo;

        if (!isset($_POST['bt_submit']))
            return false;

        array_map('trim', $_POST);

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

    private function pseudoNotExists()
    {
        $statement = $this->sql->prepare('SELECT COUNT(*) FROM membres WHERE pseudo = :pseudo');
        $statement->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);

        $statement->execute();
        $numberDoubles = $statement->fetchColumn();

        return ($numberDoubles  == 0);
    }

    private function passwordDoesntMatch()
    {
        $statement = $this->sql->prepare('SELECT * FROM membres WHERE pseudo = :pseudo');
        $statement->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);

        $statement->execute();
        $dataMember = $statement->fetch(PDO::FETCH_ASSOC);
        return !password_verify($this->mdp, $dataMember['mdp']);
    }

    private function connectMember()
    {
        $_SESSION['pseudo'] = $_POST['pseudo'];

        echo 'Connexion ok. <a href="index.php">Retour au menu principal.</a>';
        exit();
    }

    public function checkData()
    {
        if ($this->noFormSent()) return 'Veuillez vous inscrire.';
        if ($this->emptyPseudo()) return $this->erreurConnexion;
        if ($this->invalidPseudo()) return $this->erreurConnexion;
        if ($this->pseudoNotExists()) return $this->erreurConnexion;
        if ($this->passwordDoesntMatch()) return $this->erreurConnexion;


        return $this->connectMember();
    }
}
