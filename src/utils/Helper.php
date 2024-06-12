<?php

namespace Utils;

class Helper
{
    public static function env($envname, $default = null){
        return $_SERVER[$envname] ?? $_ENV[$envname] ?? $default;
    }
}
