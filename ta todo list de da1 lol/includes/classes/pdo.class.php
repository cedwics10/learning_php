<?php
require('../php/constants.php');
/** Class SqlConnect
 * Permet de faire le singleton d'une connexion Sql
 **/
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
        if (monSQL::$pdo == NULL) {
            try {
                monSQL::$pdo = new PDO(
                    "mysql:host=" . monSQL::$host . ";dbname=" . monSQL::$database,
                    monSQL::$login,
                    monSQL::$password
                );
            } catch (PDOException $e) {
                die("Erreur !: " . $e->getMessage() . "<br/>");
            }
        }
        return monSQL::$pdo;
    }
}
