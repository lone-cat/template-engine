<?php

abstract class Output
{

    public static function html($var): string
    {
        return htmlentities((string) $var);
    }

}