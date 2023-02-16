<?php
class Forum
{
    private string $nom;
    private int $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
