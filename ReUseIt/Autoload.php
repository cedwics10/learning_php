<?php
function maClasse(string $className)
{
    require_once $className . '.class.php';
}

spl_autoload_register('maClasse');
