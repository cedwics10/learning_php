<?php
$action_formulaire = 'Créer une tâche';
$desc_categories = '';
$get_link = '';
$texte_ht = '';
$texte_nom_cat = '';


/* Form tâche */
$nom_tache = '';
$date_tache = '';
$d_rappel_tache = '';
$id_categorie = '';
$description = '';
$complete = '';
/* Form tâche */

$options_categories = '';
$input_hidden = '';
$action='taches.php';


function options_categories($pdo, $slctd_cat = '')
{
	$result_exists = false;
	$stmt = $pdo->query("SELECT id, categorie FROM categories");
	$texte_options = '';
	while($row = $stmt->fetch())
	{
		$selected = '';
		if(isset($slctd_cat))
		{
			if($slctd_cat == $row['id'] )
			{
				$selected = 'selected="selected"';
			}
			
		}
		$texte_options = $texte_options . ' <option value="' . intval($row['id']) . '" ' . $selected . '>' . $row['categorie'] . '</option>';
	}
	return $texte_options;
}

function show_tasks_of_gcat($pdo, $category)
{
	$txt_taches_cat = '<table>';
	$txt_taches_cat .= '<tr><td>ID</td><td><b>Nom</b></td><td>description</td><td>date</td><td>E</td><td>X</td></tr>';

	$sql = 'SELECT id, nom_tache, description, date, id_categorie FROM taches WHERE id_categorie = ?';
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$category]);
	$taches = $stmt->fetchAll();
		
	foreach ($taches as $row) {
		extract($row);
		$txt_taches_cat .= '<tr>
			<td class="titre_tache">
			' . $id . '
			</td>
			<td class="titre_tache">
				' . $nom_tache . '
			</td>
			<td class="titre_tache">
			' . $description . '
			</td>
			<td class="titre_tache">
			' . $date . '
			</td>
			<td>
				<a href="taches.php?editer=' . $id . '&id_categorie=' . $id_categorie . '">E</a>
			</td>' . PHP_EOL . '
			<td>
				<a href="taches.php?supprimer=' . $id . '">X</a>
			</td>' . PHP_EOL;
	}

	$txt_taches_cat .= '</table>';
	return $txt_taches_cat;
}


function e_task_opt_cat($pdo, $id_task = '')
{
	$id_cat = '';
	
	$result_exists = false;
	$stmt = $pdo->query("SELECT id, categorie FROM categories");
	
	$stmt_bis = $pdo->prepare("SELECT id_categorie FROM taches WHERE id = ?");
	$stmt_bis->execute([$id_task]);
	$nb_tasks = $stmt_bis->rowCount();
	if($nb_tasks == 1)
	{
		$row_tasks = $stmt_bis->fetch();
		$id_cat = $row_tasks['id_categorie'];
	}
	
	$texte_options = '';
	while($row = $stmt->fetch())
	{
		$selected = '';
		if($id_cat == $row['id'] )
		{
			$selected = 'selected';
		}
		$texte_options = $texte_options . ' <option  value="' . intval($row['id']) . '"' 
										. $selected . '>' 
										. $row['categorie'] 
										. '</option>';
	}
	return $texte_options;
}

if(isset($_POST['nouvelle_tache']))
{
	if(isset($_POST['id_categorie']) 
		and isset($_POST['nom_tache']) 
		and isset($_POST['date_tache']))
	{
		$sql_query = 'SELECT COUNT(*) FROM categories' 
		.  ' WHERE categories.id =  ?';
		$stmt = $pdo->prepare($sql_query);
		$stmt->execute([$_POST['id_categorie']]);
		$nb_cat_tache = $stmt->fetchColumn();
		
		if($nb_cat_tache == 1)
		{
			$sql_query = 'SELECT COUNT(*) FROM taches WHERE taches.id_categorie = ' . $_POST['id_categorie'] . ' AND taches.nom_tache = "' . $_POST['nom_tache'] .'"';
			$res = $pdo->query($sql_query);
			$nb_taches_idtq = $res->fetchColumn();

			if($nb_taches_idtq == 0)
			{
				if(preg_match("#^[0-9]{4}-[0-9]{2}-[0-9]{2}$#", $_POST['date_tache']))
				{
					$sql = "INSERT INTO taches (id, id_categorie, nom_tache, description, date) VALUES (?, ?, ?,?,?)";
					$stmt= $pdo->prepare($sql);
					$stmt->execute(['', $_POST['id_categorie'], $_POST['nom_tache'], $_POST['description'], $_POST['date_tache']]);
					$texte_ht = 'Nouvelle tâche envoyée avec succès';
				}
				else
				{
					$texte_ht = 'La date entrée est dans un format incorrect.<br />';
				}
			}
			else
			{
				$texte_ht = "Une tâche a déjà un nom identique à ce que vous voulez créer dans la catégorie courante de cette tâche.";
			}
		}
		else
		{
			$texte_ht = "La catégorie pour la tâche n'existe pas : $nb_cat_tache <br />";
		}
	}
	else
	{
		$texte_ht = 'Vous n\'avez pas rempli le formulaire.';
	}

	$id_categorie = $_POST['id_categorie'];
	$nom_tache = $_POST['nom_tache'];
	$dat_tache = $_POST['date_tache'];

}


if(isset($_GET['id_categorie']) and $_GET['id_categorie'] != "")
{
	$id_categorie = $_GET['id_categorie'];
	$sql = 'SELECT COUNT(categorie) FROM categories WHERE categories.id = ?';
	$stmt= $pdo->prepare($sql);
	$stmt->execute([$id_categorie]);
	
	$nb_cat_id = $stmt->fetchColumn();
	
	if($nb_cat_id == 1)
	{
		$texte_nom_cat = 'Tâches de la catégorie';
		$desc_categories = show_tasks_of_gcat($pdo, $id_categorie);
	}
	else
	{
		$texte_nom_cat = "La catégoriede numéro $id_categorie n'existe pas.";
	}
}
else
{
	$texte_nom_cat = 'Veuillez séléctionnez une catégorie';
}

if(isset($_POST['editer_tache']) and isset($_GET['editer']))
{
	$query = 'SELECT COUNT(*) FROM taches WHERE id = ?';
	$stmt = $pdo->prepare($query);
	$stmt->execute([$_GET['editer']]);
	$nb_taches = $stmt->fetchColumn();
	if($nb_taches == 1)
	{
		$sql_query = 'SELECT COUNT(*) FROM taches WHERE taches.id != ?' 
		. ' AND taches.id_categorie = ?'
		. ' AND taches.nom_tache = ?';
		$stmt = $pdo->prepare($sql_query);
		$stmt->execute([$_GET['editer'], $_POST['id_categorie'], $_POST['nom_tache']]);
		
		$nb_taches_idtq = $stmt->fetchColumn();
		if($nb_taches_idtq == 0)
		{
			if(preg_match("#^[0-9]{4}-[0-9]{2}-[0-9]{2}$#", $_POST['date_tache']))
			{
				echo '<pre>';
				print_r($_POST);
				echo'</pre>';

				if(!isset($_POST['complete']))
				{
					$_POST['complete'] = 0;
				}

				$sql = "UPDATE taches SET" 
				. " id_categorie = ?," 
				. " nom_tache = ?,"
				. " description = ?,"
				. " date = ?,"
				. " complete = ?"
				. " WHERE id = ?";
				$stmt= $pdo->prepare($sql);
				$stmt->execute(
					[$_POST['id_categorie'], 
						$_POST['nom_tache'], 
						$_POST['description'], 
						$_POST['date_tache'],
						$_POST['complete'],
						$_GET['editer']
					]
				);
				$texte_ht = "Tâche \"{$_POST['nom_tache']}\" modifiée avec succès";
			}
			else
			{
				$texte_ht = 'La date de la tâche à éditer est incorrecte.';
			}
		}
		else
		{
			$texte_ht = 'La tâche à modifier a un nom identique à une autre tâche dans la catégorie X';
		}
	}
	else
	{
		$texte_ht = 'La tâche à éditer n\'existe pas.';
	}
}

if(isset($_GET['editer']))
{

	$sql = 'SELECT complete, date, description, id_categorie, nom_tache FROM taches WHERE id = ?';
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$_GET['editer']]);
	$count = $stmt->rowCount();

	if($count == 1)
	{
		$tache = $stmt->fetch();
		extract($tache);
		$complete = ($complete == 1) ? 'checked' : '';

		$date_tache = substr($date,0,10);
		// $d_rappel_tache = substr($d_rappel_tache,0,10);
	
		$action_formulaire = 'Éditer la tâche : <i>"' . $nom_tache . '</i>"';
		$input_hidden = '<input type="hidden" name="editer_tache" />';

		$get_link = '?editer=' . $_GET['editer'] . '&id_categorie=' . $id_categorie;
	}

	$options_categories =  e_task_opt_cat($pdo, $_GET['editer']);
	// $desc_categories = show_tasks_of_gcat($pdo, $id_categorie);
}

elseif(isset($_GET['id_categorie']))
{
	$options_categories = options_categories($pdo, $_GET['id_categorie']);
	$input_hidden = '<input type="hidden" name="nouvelle_tache" />';
}
else
{
	$options_categories = options_categories($pdo);

}
?>