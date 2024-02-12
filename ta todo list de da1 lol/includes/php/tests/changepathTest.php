<?php
use PHPUnit\Framework\TestCase as TestCase;

class changepathTest extends TestCase
{
    public function testEmptyP() 
    {
        $this->assertEquals(changebasename(''), '/', 'Empty parameters returns empty');
    }

    public function testSimplePEdit() 
    {
        $this->assertEquals(changebasename('C:/Fichiers/Avatar/jour/lundi.jpg', 'vendredi.jpg'), 'C:/Fichiers/Avatar/jour/vendredi.jpg', 'Mere directory editing');
    }
}
?>