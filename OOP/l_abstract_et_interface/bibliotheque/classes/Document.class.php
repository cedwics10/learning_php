<?php
abstract class Document
{
    protected string $noEnreg;
    protected string $titre;

    public function __construct(string $noEnreg, string $titre)
    {
        $this->noEnreg = $noEnreg;
        $this->titre = $titre;
    }

    public function __toString()
    {
        $typeDoc = strtolower(get_class($this));
        return '* [' . $this->noEnreg . '] Le document actuel est un ' .  $typeDoc . ' et se nomme "' . $this->titre . '".' . "\n";
    }

    abstract public function getNiveau();
}
