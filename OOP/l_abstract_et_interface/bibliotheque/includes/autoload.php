<?php
function loader($newClass)
{
    require_once "classes/{$newClass}.class.php";
}


spl_autoload_register('loader');
