<?php
class Chat extends Animal
{
    public function makesound()
    {
        print 'Miaou !';
    }

    public function __toString()
    {
        'L\'animal est un chat et a pour nom : ' . $this->nom;
    }
}
