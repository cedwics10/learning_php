<?php
class Reservoir
{
    private float $volume;
    private float $niveau;

    private const NIVEAU_MAX = 100.0;
    private const NIVEAU_MIN = 0.0;
    private const VOLUME_MIN = 10.0;
    private const VOLUME_MAX = 100.0;

    public function __construct(float $niveau, float $volume)
    {
        $this->niveau = $niveau;
        $this->volume = $volume;
    }

    public function getNiveau()
    {
        echo $this->niveau;
    }

    public function getVolume()
    {
        echo $this->volume;
    }

    public function __toString()
    {
        echo  'Le réservoir a pour niveau ' . strval($this->niveau) . ' et a pour volume ' . strval($this->volume);
    }

    public function remplir(float $v)
    {
        if ($this->niveau + $v <= self::NIVEAU_MAX)
            $this->niveau += $v;
        else
            $this->niveau = self::NIVEAU_MAX;
    }

    public function vider(float $v)
    {
        if ($this->niveau - $v >= self::NIVEAU_MIN)
            $this->niveau -= $v;
        else
            $this->niveau = self::NIVEAU_MIN;
    }
}
