<?php
function charger($newClass)
{
    require_once "$newClass.class.php";
}

spl_autoload_register('charger');


$livre = new Livre('Le PHP pour les nuls', 300);
echo $livre;
