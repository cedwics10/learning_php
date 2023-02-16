<?php
class Connexion
{
    static $server = '';
    static $username = '';
    static $password = '';
    static $database = '';
    static $Pdo;

    public static function getConnexion()
    {
        if (is_null(self::$Pdo)) {
            self::$Pdo = new Pdo(self::$server, self::$username, self::$password);
        }
    }
}
