<?php

class TranslateModelName{
    public static function getTranstalion($modname){
        switch ($modname) {
            case('Benefits'):
                $rez = '"Пільги"';
                break;
            case('Benefit'):
                $rez = '"Пільги"';
                break;
            case('Countries'):
                $rez = '"Країни громадянства"';
                break;
            case('Countrу'):
                $rez = '"Країни громадянства"';
                break;
            case('PersonSexTypes'):
                $rez = '"Статі"';
                break;
            case('PersonSexType'):
                $rez = '"Статі"';
                break;           
            default:
                $rez = $modname;
                
        }
        return $rez;
    }
}
?>
