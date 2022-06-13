<?php

declare(strict_types=1);

namespace Astrotomic\Path\Posix;

use Astrotomic\Path\AbstractPath;
use Astrotomic\Path\PathString;

class Path extends AbstractPath
{
    public static string $delimiter = ":";
    public static string $separator = "/";

    public static function basename(string $path, ?string $ext = null): string
    {
        // TODO: Implement basename() method.
        return 'UNDEFINED';
    }

    public static function dirname(string $path): string
    {
        // TODO: Implement dirname() method.
        return 'UNDEFINED';
    }

    public static function extname(string $path): string
    {
        // TODO: Implement extname() method.
        return 'UNDEFINED';
    }

    public static function format(PathString $pathObject): string
    {
        // TODO: Implement format() method.
        return 'UNDEFINED';
    }

    public static function isAbsolute(string $path): bool
    {
        // TODO: Implement isAbsolute() method.
        return false;
    }

    public static function join(string ...$paths): string
    {
        // TODO: Implement join() method.
        return 'UNDEFINED';
    }

    public static function normalize(string $path): string
    {
        // TODO: Implement normalize() method.
        return 'UNDEFINED';
    }

    public static function parse(string $path): PathString
    {
        // TODO: Implement parse() method.
        return new PathString();
    }

    public static function relative(string $from, string $to): string
    {
        // TODO: Implement relative() method.
        return 'UNDEFINED';
    }

    public static function resolves(string ...$paths): string
    {
        // TODO: Implement resolves() method.
        return 'UNDEFINED';
    }

    /**
     * Always NoOP for *nix systems.
     * @param string $path
     *
     * @return string
     */
    public static function toNamespacedPath(string $path): string
    {
        return $path;
    }
}