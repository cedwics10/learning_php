<?php
class Dictionnaire extends Document
{

    const LANGUES_POSSIBLE = ["français", "anglais", "allemand", "espagnol"];

    private int $nbPages;
    private string $langue;

    public function __construct(string $noEnreg, string $titre, int $nbPages, string $langue = '')
    {
        $this->titre = $titre;

        $this->noEnreg = $noEnreg;
        $this->nbPages = $nbPages;
        $this->langue = '';
        if (in_array(strtolower($langue), self::LANGUES_POSSIBLE))
            $this->langue = $langue;
    }


    public function getNiveau(): float
    {
        return $this->nbPages * 1.5;
    }

    public function __toString()
    {
        $typeDoc = strtolower(get_class($this));
        return parent::__toString()
            .  '- Ce ' .  $typeDoc . ' fait ' . $this->nbPages . ' pages.' . PHP_EOL
            .  '- Ce ' .  $typeDoc . ' est en ' . $this->langue . '.' . PHP_EOL;
    }
}
