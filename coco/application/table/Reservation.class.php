<?php

/**
Classe créé par le générateur.
 */
class Reservation extends Table
{
	public function __construct()
	{
		parent::__construct("reservation", "res_id");
	}

	public function selectAll(): array
	{
		$sql = "SELECT uti_id, uti_nom, uti_prenom,
		uti_email, uti_mdp, uti_profil, esp_nom, 
		CONCAT(uti_prenom, ' ', uti_nom) uti_nc,
		res_id, res_date_creation, res_date_debut,res_date_fin, res_date_fin
		res_nbposte, res_utilisateur, res_espace
		FROM reservation, espace, utilisateur
		WHERE res_utilisateur = uti_id AND res_espace = esp_id";
		$result = self::$link->query($sql);
		return $result->fetchAll();
	}
}
