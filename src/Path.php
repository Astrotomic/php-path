<?php

declare(strict_types=1);

namespace Astrotomic\Path;

use Astrotomic\Path\Posix\Path as PosixPath;
use Astrotomic\Path\Win32\Path as Win32Path;

class Path extends AbstractPath
{
    public static function isWindows(): bool
    {
        return (PHP_OS_FAMILY === 'Windows');
    }

    public static function posix(): PosixPath|PathContract
    {
        return new PosixPath();
    }

    public static function win32(): Win32Path|PathContract
    {
        return new Win32Path();
    }

    private static function getPlatformApi(): Win32Path|PosixPath
    {
        return static::isWindows() ? static::win32() : static::posix();
    }

    public static function delimiter(): string
    {
        return static::getPlatformApi()::delimiter();
    }

    public static function separator(): string
    {
        return static::getPlatformApi()::separator();
    }

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

    public static function format(PathObject $pathObject): string
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

    public static function parse(string $path): PathObject
    {
        // TODO: Implement parse() method.
        return new PathObject();
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

    public static function toNamespacedPath(string $path): string
    {
        return static::getPlatformApi()::toNamespacedPath($path);
    }
}