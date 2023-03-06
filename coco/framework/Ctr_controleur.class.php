<?php
//class mère des controleurs secondaires
class Ctr_controleur
{
    protected string $module;
    protected string $action;
    protected string $gabarit;
    protected string $vue;

    public function __construct(string $module, string $action, string $gabarit = "gabarit.php")
    {
        $this->module = $module;
        $this->action = $action;
        $this->gabarit = "../application/gabarit/$gabarit";
        $this->vue = "../application/module/{$module}/vue_{$module}_{$action}.php";
    }
}
