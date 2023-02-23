<?php
class SocieteMed
{
    private string $label;
    private array $vehicules;

    public function __construct(string $label)
    {
        $this->label = $label;
    }
}
