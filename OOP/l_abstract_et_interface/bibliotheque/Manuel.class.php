<?php
class Manuel extends Livre implements Scolaire
{
    private int $niveau;
    public function getDifficulte(): float
    {
        return parent::getDifficulte() * 1.5;
    }

    public function getNiveau(): string
    {
        return $this->niveau;
    }
}
