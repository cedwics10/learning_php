<?php
abstract class Document
{
    protected string $noEnreg;
    protected string $titre;

    // getters
    abstract public function getNiveau(): float;
    abstract public function getNoEnreg(): string;
    abstract public function getTitre(): string;

    // setters
    abstract public function setNoEnreg(string $noEnreg);

    abstract public function __toString();
}
