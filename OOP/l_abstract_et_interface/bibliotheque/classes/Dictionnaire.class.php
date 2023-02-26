<?php
interface Tarductible
{
    const LANGUES_POSSIBLE = ["français", "anglais", "allemand", "espagnol"];
    public function getLangue();
}

class Dictionnaire extends Document implements Tarductible
{
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

    public function getNbPages(): int
    {
        return $this->nbPages;
    }

    public function getLangue(): string
    {
        return $this->langue;
    }
    public function getNiveau(): float
    {
        return $this->nbPages * 1.5;
    }


    public function getTitre(): string
    {
        return $this->titre;
    }


    public function getNoEnreg(): string
    {
        return $this->noEnreg;
    }


    public function setNoEnreg(string $noEnreg)
    {
        $this->noEnreg = $noEnreg;
    }

    public function __toString()
    {
        $typeDoc = strtolower(get_class($this));
        return '- Le document actuel est un ' .  $typeDoc . ' et se nomme "' . $this->titre . '".' . PHP_EOL
            .  '- Ce ' .  $typeDoc . ' fait ' . $this->nbPages . ' pages.' . PHP_EOL;
    }
}
