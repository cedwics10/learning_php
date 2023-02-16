<?php
class Entreprise
{
    public string $label;
    public array $salaries;


    public function  __construct(string $label)
    {
        $this->label = $label;
    }
    public function AjouterSalarie(Salarie $s): void
    {
        $this->salaries[] = $s;
    }

    public function  calculerMasseSalariale(): float
    {
        $this->salaries->ge
    }
}
