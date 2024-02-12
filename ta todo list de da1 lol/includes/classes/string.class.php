<?php 
class StringTodo
{
    static public $pdo;

    public static function init() {
        self::$pdo = monSQL::getPdo();
    }

    public static function update_set_equalities($value)
    {
        return $value . ' = ?';
    }

    public static function string_set_equalities($update_data)
	{
		$update_data = array_map('self::update_set_equalities', array_keys($update_data));
        return implode(',', $update_data);
	}
}
