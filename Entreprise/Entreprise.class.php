<?php
class Entreprise
{
    private string $label;
    private array $salaries;


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
        $masseSa = (float) 0;
        foreach ($this->salaries as $salarie) {
            $masseSa += $salarie->getSalaire();
        }
        return $masseSa;
    }

    public function __toString()
    {
        return '* L\'entreprise "' . $this->label . '" a pour masse salariale : ' . $this->calculerMasseSalariale() . '€<br />';
    }
}
