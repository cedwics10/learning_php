<?php
session_start();
include('constants.php');
// include('../classes/pdo.class.php');
class monSQL
{
    /**
	* @var string Connexion server
	**/
    private static $host = 'localhost';
    /**
	* @var string Database
	**/
    private static $database = 'tasker';
    /**
	* @var string Connexion login
	**/
    private static $login = 'root';
    /**
	* @var string Connexion password
	**/
    private static $password = '';
    /**
	* @var string PHP data object
	**/
    private static $pdo = NULL;

    /**
    * @ return
    **/
    public static function getPdo()
    {  
        if(monSQL::$pdo == NULL)
        {
            try
            {
                monSQL::$pdo = new PDO("mysql:host=" . monSQL::$host . ";dbname=" . monSQL::$database , 
                monSQL::$login, monSQL::$password);
            }
            catch (PDOException $e) 
            {
                die("Erreur !: " . $e->getMessage() . "<br/>");
            }
        }
        return monSQL::$pdo;
    }

}


setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');



function new_cookiee($nom, $valeur)
{
	setcookie($nom, $valeur, time() + NUMBER_OF_SECONDS_IN_A_YEAR);
	$_COOKIE[$nom] = $valeur;
    return false;
}

function implode_get_pieces(&$value, $key = '')
{
    $value = $key . '=' . $value;
}

function make_stripped_get_args_link($get_args_to_remove = [], $mock_get_args = [], $extra_text = '')
{
    if(count($_GET) === 0 AND count($get_args_to_remove) === 0 
    AND count($mock_get_args) === 0 AND trim($extra_text) === '')
    {
        return '?';
    }
    
    $_COPY_GET = $_GET;
    ksort($_COPY_GET);

    foreach($get_args_to_remove AS $key_to_remove)
	{
        unset($_COPY_GET[$key_to_remove]);
	}
    
    $union_get_mock_get = array_replace($_COPY_GET,$mock_get_args);
    ksort($union_get_mock_get, SORT_STRING);

    array_walk($union_get_mock_get, 'implode_get_pieces');
    return '?' . implode('&amp;', $union_get_mock_get) . $extra_text;
}

function changebasename(string $file_dir = '', string $new_basename = '')
{  
    $extension = pathinfo($file_dir,  PATHINFO_EXTENSION);
    return $new_basename .'.' . $extension;
}


function avatar_properties_ok()
{
    list($avatar_width, $avatar_height, $type, $attr) = getimagesize($_FILES['avatar']['tmp_name']);
    $is_avatar_nottoobig = (intval($avatar_width) <= MAX_LENGTH_IMAGES
    AND intval($avatar_height) <= MAX_HEIGHT_IMAGES);
    return $is_avatar_nottoobig;
}

function check_uploaded_avatar()
{
    if(empty($_FILES['avatar']['tmp_name'])) 
        return AVATAR_OK;
    
    $avatar_extension = pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION);

    if(!in_array($avatar_extension, AVATAR_EXTENSION_OK))
        return AVATAR_NOT_OK;
    
    if(avatar_properties_ok())
        return AVATAR_OK;
    
    return AVATAR_NOT_OK;
    
}

function connecte()
{
    return isset($_SESSION['id']);
}

function avatar_not_ok()
{
    return !check_uploaded_avatar();
}
