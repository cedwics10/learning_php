<?php
class Ctr_authentification extends Ctr_controleur
{

    public function __construct($action)
    {
        parent::__construct("authentification", $action);
        $a = "a_$action";
        $this->$a();
    }

    public function a_inscription()
    {
        extract($_POST);
        if (isset($_SESSION["uti_id"])) {
            $_SESSION["message"][] = "Tentative d'intrusion détectée...";
            require $this->gabarit;
            exit;
        }

        if (isset($btSubmit)) {
            //vérifier que $uti_email est unique
            if (!Utilisateur::estEmailUnique($uti_email)) {
                $_SESSION["message"][] = "$uti_email : cette adresse mail est déjà prise. Veuillez en saisir une autre.";
                require $this->gabarit;
                exit;
            }

            //vérifier que $uti_mdp==$uti_mdp2
            if ($uti_mdp != $uti_mdp2) {
                $_SESSION["message"][] = "La vérification du mot de passe à échouer. Veuillez vérifier votre mot de passe.";
                require $this->gabarit;
                exit;
            }

            //Tous est ok : enregistrement du nouvel utilisateur
            $_POST["uti_id"] = 0;
            $_POST["uti_mdp"] = password_hash($_POST["uti_mdp"], PASSWORD_DEFAULT);
            $_POST["uti_profil"] = "client";
            (new Utilisateur)->save($_POST);
            $_SESSION["message"][] = "Bravo $uti_prenom ! Inscription réussie. Vous pouvez maintenant vous connecter.";
            //rediriger sur l'accueil
            header("location:" . hlien("_default"));
        } else {
            //affichage du formulaire
            extract((new Utilisateur())->emptyRecord());
            require $this->gabarit;
        }
    }

    public function a_connexion()
    {
        if (isset($_SESSION["uti_id"])) {
            $_SESSION["message"][] = "Tentative d'intrusion détectée...";
            require $this->gabarit;
            exit;
        }

        extract($_POST);
        if (isset($btSubmit)) {
            //récupérer en bdd l'utilisateur qui posséde $uti_email
            $row = Utilisateur::selectByEmail($uti_email);

            if ($row === false) {
                $_SESSION["message"][] = "$uti_email n'existe pas. Vérifiez votre saisie";
                require $this->gabarit;
                exit;
            }

            //vérification du mot de passe
            if (!password_verify($uti_mdp, $row["uti_mdp"])) {
                $_SESSION["message"][] = "Mot de passe incorrect.";
                require $this->gabarit;
                exit;
            }

            //Connexion réussie
            extract($row);
            $_SESSION["uti_id"] = $uti_id;
            $_SESSION["uti_nom"] = $uti_nom;
            $_SESSION["uti_prenom"] = $uti_prenom;
            $_SESSION["uti_email"] = $uti_email;
            $_SESSION["uti_profil"] = $uti_profil;
            $_SESSION["message"][] = "bienvenu $uti_prenom $uti_nom.";
            header("location:" . hlien("_default"));
        } else {
            $uti_email = "";
            require $this->gabarit;
        }
    }

    public function a_deconnexion()
    {
        $_SESSION = [];
        $_SESSION["message"][] = "Vous êtes bien déconnecté.";
        header("location:" . hlien("_default"));
    }
}
