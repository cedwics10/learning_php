<?php 
try 
{
    $pdo = new PDO('mysql:host=localhost;dbname=tasker', 'root', '');
}
catch (PDOException $e) 
{
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

function qmark_part($except = [], $extension = '')
{
    if(count($_GET) == 0 and strlen($extension) == 0)
    {
        return '?';
    }

    $get_text = [$extension];
    foreach($_GET as $key => $value)
    {
        if(!(array_key_exists($key,$except)))
        {
            $get_text[] = "$key=$value";
        }
        
    }

    return '?' . implode('&', $get_text);

}
?>