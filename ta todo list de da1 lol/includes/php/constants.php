<?php
const NUMBER_OF_SECONDS_IN_A_YEAR = 365*24*3600;
const TIMESTAMP_ZERO = '1970-01-01';
const FAR_FAR_AWAY_DATE = '2999-12-12';

const AVATAR_OK = true;
const AVATAR_NOT_OK = false;

const MIN_L_PASSWORD = 6;
const MAX_L_PASSWORD = 20;
const MIN_L_PSEUDO = 3;
const MAX_L_PSEUDO = 20;

const MAX_HEIGHT_IMAGES = 600;
const MAX_LENGTH_IMAGES = 600;
const AVATAR_EXTENSION_OK = ["jpg", "jpeg", "png", "bmp", "gif"];

const MAX_IMPORTANCE_TASKS = 3;
const MIN_IMPORTANCE_TASKS = 1;

const SUCCESSFUL_SIGNUP = 'inscription_reussie';
const SUCCESSFUL_SIGNIN = 'connexion_reussie';

const DEFAULT_ORDER_TASKS = 'nom';
const ARRAY_ORDER_BY_TACHES = [
	'date' => 'taches.date', 
	'nom' =>'taches.nom_tache',
	'categorie' => 'categories.categorie',
	'importance' =>'taches.importance'
];
const TASK_IS_COMPLETED = 1;
const TASK_NOT_COMPLETED = 0;
const REGEX_VALID_TASKDATE = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';

const SHOW_COMPLETED_TASKS = 1;
const HIDE_COMPLETED_TASKS = 0;

const MIN_LENGTH_CATEGORY_NAME = 3;
const MAX_LENGTH_CATEGORY_NAME = 100;

const RESET_HEADER_ADMIN = true;
const IS_AN_ADMIN = 'a';
const IS_A_MEMBER = 'm';

const SUCCESSFUL_LOGIN_PAGE = 'index.php?reussi=connecte';

define('SUCCESSFUL_LOGIN_MESSAGE', 
isset($_GET[SUCCESSFUL_SIGNIN]) ? 'Vous êtes connecté. Bienvenu.' : '' );

class TasksConst
{
	public static $show_completed_tasks = SHOW_COMPLETED_TASKS;
	public static $get_arg_complete = 1;
	public static $str_complete = 'Masquer';
	public static $where_complete = '';
	public static $where_categorie = '';
	
	public static $id_membre = '';

	
	public static $comparaison_date = '';
}
