<?php

namespace Core\Traits;

trait Helpers 
{

    public static function getHash(string $string)
    {
        $hash = password_hash($string, PASSWORD_BCRYPT);
        return $hash;
    }

}