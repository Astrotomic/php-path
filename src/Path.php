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
        return static::getPlatformApi()::basename($path, $ext);
    }

    public static function dirname(string $path): string
    {
        return static::getPlatformApi()::dirname($path);
    }

    public static function extname(string $path): string
    {
        return static::getPlatformApi()::extname($path);
    }

    public static function format(PathObject $pathObject): string
    {
        return static::getPlatformApi()::format($pathObject);
    }

    public static function isAbsolute(string $path): bool
    {
        return static::getPlatformApi()::isAbsolute($path);
    }

    public static function join(string ...$paths): string
    {
        return static::getPlatformApi()::join(...$paths);
    }

    public static function normalize(string $path): string
    {
        return static::getPlatformApi()::normalize($path);
    }

    public static function parse(string $path): PathObject
    {
        return static::getPlatformApi()::parse($path);
    }

    public static function relative(string $from, string $to): string
    {
        return static::getPlatformApi()::relative($from, $to);
    }

    public static function resolves(string ...$paths): string
    {
        return static::getPlatformApi()::resolves(...$paths);
    }

    public static function toNamespacedPath(string $path): string
    {
        return static::getPlatformApi()::toNamespacedPath($path);
    }
}
