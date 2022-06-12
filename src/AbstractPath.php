<?php

namespace Astrotomic\Path;

abstract class AbstractPath implements PathContract
{
    private static string $delimiter;
    private static string $separator;

    public static function delimiter(): string
    {
        return static::$delimiter;
    }

    public static function separator(): string
    {
        return static::$separator;
    }
}
