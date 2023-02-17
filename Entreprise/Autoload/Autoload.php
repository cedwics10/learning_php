<?php
function loadClass($className)
{
    require_once "$className.class.php";
}

spl_autoload_register(
    'loadClass'
);
