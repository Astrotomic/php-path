<?php

namespace Astrotomic\Path\Posix;

use Astrotomic\Path\AbstractPath;
use Astrotomic\Path\PathObject;
use JetBrains\PhpStorm\Pure;

class Path extends AbstractPath
{
    public static string $delimiter = ":";
    public static string $separator = "/";

    public static function basename(string $path, ?string $ext = null): string
    {
        // TODO: Implement basename() method.
    }

    public static function dirname(string $path): string
    {
        // TODO: Implement dirname() method.
    }

    public static function extname(string $path): string
    {
        // TODO: Implement extname() method.
    }

    public static function format(PathObject $pathObject): string
    {
        // TODO: Implement format() method.
    }

    public static function isAbsolute(string $path): bool
    {
        // TODO: Implement isAbsolute() method.
    }

    public static function join(string ...$paths): string
    {
        // TODO: Implement join() method.
    }

    public static function normalize(string $path): string
    {
        // TODO: Implement normalize() method.
    }

    public static function parse(string $path): PathObject
    {
        // TODO: Implement parse() method.
    }

    public static function relative(string $from, string $to): string
    {
        // TODO: Implement relative() method.
    }

    public static function resolves(string ...$paths): string
    {
        // TODO: Implement resolves() method.
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
