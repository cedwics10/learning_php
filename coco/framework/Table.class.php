<?php

/**
 * classe mère pour gérer les tables de la BDD
 * propose les requetes génériques du CRUD
 */
class Table
{
	//connexion PDO à la BDD
	public static $link;
	//nom de la table
	public string $table;
	//Nom du champ clé primaire
	public string $pk;

	/**
	 * Constructeur
	 *
	 * @param string $table        	
	 * @param string $pk        	
	 */
	public function __construct(string $table, string $pk)
	{
		$this->table = $table;
		$this->pk = $pk;
	}

	/**
	 * Retourne tous les enregistrements de la table
	 * 
	 * @return array
	 */
	public function selectAll(): array
	{
		$sql = "select * from $this->table";
		$result = self::$link->query($sql);
		return $result->fetchAll();
	}

	/**
	 *  retourne un enregistrement depuis la base de données
	 *
	 * @param integer $id        	
	 */
	function select(int $id)
	{
		$sql = "select * from $this->table where $this->pk=:id";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetch();
	}

	//retourne un enregistrement vide
	function emptyRecord(): array
	{
		$fields = $this->getFields();
		$row = [];
		foreach ($fields as $name)
			$row[$name] = "";
		$row[$this->pk] = 0;
		return $row;
	}

	/**
	 * retourne un tableau contenant le nom des champs de la table
	 *
	 * @return array
	 */
	function getFields(): array
	{
		$fields = [];
		$sql = "show columns from $this->table";
		$result = self::$link->query($sql);
		foreach ($result as $row)
			$fields[] = $row["Field"];

		return $fields;
	}

	/**
	 * retourne la chaine SQL (préparé pour PDO) de mise a jour d'un enregistrement de $table
	 *
	 * @return string
	 */
	function updateSql(array $fields)
	{
		foreach ($fields as $name) {
			if ($name != $this->pk)
				$ar[] = $name . "=:" . $name;
		}

		$sql = "update $this->table set " . implode(",", $ar) . " where $this->pk = :" . $this->pk;
		return $sql;
	}

	/**
	 * retourne la chaine SQL (préparé pour PDO) d'insertion d'un enregistrement dans $table :nomchamp
	 *
	 * @return string
	 */
	function insertSql(array $fields)
	{
		foreach ($fields as $name) {
			if ($name != $this->pk)
				$ar[] = ":" . $name;
		}

		$sql = "insert into $this->table values (null," . implode(",", $ar) . ")";
		return $sql;
	}


	/**
	 * Enregistre en base de données l'enregistrement $row
	 * si id > 0 update SINON insert
	 * retourne l'id
	 */
	function save($row): int
	{
		$fields = $this->getFields();

		if ($row[$this->pk] > 0) {
			$sql = $this->updateSql($fields);
		} else {
			$sql = $this->insertSql($fields);
		}

		$statement = self::$link->prepare($sql);
		foreach ($row as $name => $value) {
			//si $name est un nom de champ qui existe dans la table
			if (in_array($name, $fields)) {
				if ($this->pk != $name or $row[$this->pk] > 0)
					$statement->bindValue(":" . $name, $value);
			}
		}

		$statement->execute();

		//si création d'un enregsitrement : récupère l'id 
		if ($row[$this->pk] == 0)
			return self::$link->lastInsertId();
		else
			return $row[$this->pk];
	}

	/**
	 * execute la suppression d'un enregsitrement
	 * @param integer $id		: id de l'enregistrement
	 */
	function delete($id)
	{
		$sql = "delete from $this->table where $this->pk=:id";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();
	}

	/**
	 * fonction générique pour générer les balises OPTION d'un SELECT
	 *
	 * @param string $sql requete sql
	 * @param string $pk nom du champ pk primaire
	 * @param string $label nom du champ à afficher dans la balise OPTION
	 * @param integer $id valeur à préselectionner
	 */
	static public function HTMLselect($sql, $pk, $label, $id)
	{
		$resultat = self::$link->query($sql);
		$s = "";
		foreach ($resultat as $tab) {
			if ($tab[$pk] == $id)
				$sel = " selected ";
			else
				$sel = "";

			$s = $s . "<option $sel value='$tab[$pk]'>$tab[$label]</option>";
		}
		return $s;
	}

	static public function getTablesNames() {
		$sql = "show tables";
        $result = self::$link->query($sql,PDO::FETCH_BOTH);
        $data=[];
        foreach ( $result as $row)
            $data[]=$row[0];

		return $data;
	}
}
