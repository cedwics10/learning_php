<?php
/**
Classe créé par le générateur.
*/
class Utilisateur extends Table {
	public function __construct() {
		parent::__construct("utilisateur", "uti_id");
	}

	static public function estEmailUnique(string $uti_email) : bool {
		$sql="select * from utilisateur where uti_email=:mail";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":mail", $uti_email);
		$statement->execute();
		if ($statement->rowCount()>0)
			return false;
		else 
			return true;
	}

	static public function selectByEmail(string $uti_email) {
		$sql="select * from utilisateur where uti_email=:mail";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":mail", $uti_email);
		$statement->execute();
		return $statement->fetch();
	}
}
?>
