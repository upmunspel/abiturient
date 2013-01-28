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
        }
        return $rez;
    }
}
?>
