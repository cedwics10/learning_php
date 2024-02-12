<?php
/** Class Tache
* Permet de créer, modifier et uploader une tâche rapidement
**/ 
class Task # SINGLETON PDO
{
	/**
	* @var Pdo Database connexion
	**/
	private $pdo;

	/**
	* @var array All data of task
	**/
	private $array_data;

	/**
	* @var bool Is data checked before update
	**/
	private $task_array_checked;

	/**
	* @param Pdo Data object, this class is made on the scope of the Factory class
	* @ return : nothing , dependency injection
	**/
	public function __construct(Pdo $sql)
	{
		$this->pdo = $sql;
	}

	/**
	* @param int Task id
	* @ return
	**/
	public function select($id)
	{
		$statement = $this->pdo->prepare('SELECT * FROM taches WHERE id = ?');
		$statement->execute([$id]);
		$this->array_data = $statement->fetch(PDO::FETCH_ASSOC);
	}
	/**
	* @param string var name
	* @ return
	**/
	public function getVar($name)
	{
		return $this->task_array[$name];
	}
	/**
	* @param array Data from a _POST array
	* @ return
	**/
	private function check_update_form(array $values)
	{
		return false;
	}
	/**
	* @param array Data from a _POST var
	* @ return
	**/
	private function set_default_update_form(array $values)
	{
		return $values;
	}
	/**
	* @param array Data from a _POST var
	* @ return
	**/
	public function update(array $values = NULL)
	{
		if($values == NULL)
			return false;
		
		$form_error = $this->check_update_form($values);
		if($form_error !== false)
			return false;

		StringTodo::init();
		$set = StringTodo::string_set_equalities($values);

		$values = array_values($values);
		$values[] = $this->array_data['id'];

		$sql = "UPDATE taches 
		SET $set
		WHERE id = ?";
		
		$statement = $this->pdo->prepare($sql);
		return $statement->execute($values);
	}

	/**
	* @param array Data from a _POST var
	* @ return
	**/
	public function delete()
	{
		$sql = 'DELETE FROM taches WHERE id = ' . $this->array_data['id'];
		$this->pdo->query($sql);
	}

}
