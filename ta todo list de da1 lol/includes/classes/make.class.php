<?php
require('pdo.class.php');
require_once('task.class.php');
require('string.class.php');

/** Class Factory
* Patorn "Factory" de la majorité des classes du projet TODO
**/ 
Class Make
{
    /**
	* @var string Class to make
	**/
    static public function class(string $classname)
    {
        $pdo = monSQL::getPdo();
        $classname = strtolower($classname);
        switch ($classname) {
            case 'monsql':
                return $pdo;
            case 'task':
                return new Task($pdo);
            case 'table':
                return new Table($pdo);
            case 'stringtodo':
                return new StringTodo($pdo);
            # case 'Liste':
            #    return new List($pdo);
        }
    }
}
