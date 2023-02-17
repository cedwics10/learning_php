<?php
class Formulaire
{
    static public function createLabel(string $for, string $texte)
    {
        return "<label for='$for'>$texte</label>";
    }

    static public function createInput(string $type, string $name, string $value)
    {
        return "<input type='$type' id='$name' name='$name' value='$value'/>";
    }

    static public function createRadios(string $name, array $items, string $selected)
    {
        $radios = '';
        foreach ($items as $nomOption => $valeur) {
            $sel = ($nomOption === $selected) ? 'selected' : '';
            $radios .= self::createLabel($name, $nomOption);
            $radios .= " <input type='radio' name='$name' value='$valeur' $sel/>";
        }
        return $radios;
    }
}
