<?php

namespace Astrotomic\Path;

interface PathContract
{
    /**
     * Returns the last portion of a `path`; similar to Unix `basename` command.
     *
     * @param string      $path
     * @param null|string $ext
     *
     * @return string
     */
    public static function basename(string $path, ?string $ext = null): string;

    /**
     * Returns the directory name of a `path`; similar to Unix `dirname` command.
     * @param string $path
     *
     * @return string
     */
    public static function dirname(string $path): string;

    /**
     * Returns the extension of the `path`; from the last occurrence of the `.` character to the end.
     * If there is no `.` in the last path part an empty string is provided.
     *
     * @param string $path
     *
     * @return string
     */
    public static function extname(string $path): string;

    /**
     * Returns a path string from a path object.
     *
     * @param PathObject $pathObject - This might end up just being a placeholder for something better.
     *
     * @return string
     */
    public static function format(PathObject $pathObject): string;

    /**
     * Determines if the `path` is an absolute path.
     *
     * @param string $path
     *
     * @return bool
     */
    public static function isAbsolute(string $path): bool;

    /**
     * Joins all the given path segments together using the platform separator, then normalizes resulting path.
     *
     * @param string ...$paths
     *
     * @return string
     */
    public static function join(string ...$paths): string;

    /**
     * Normalize a path to resolve `..` and `.` segments.
     *
     * When multiple sequent path segments are found they will be replaced with a single instance.
     * Trailing seperators are preserved.
     *
     * if the path is a zero-length string, then `'.'` will be returned representing CWD.
     * @param string $path
     *
     * @return string
     */
    public static function normalize(string $path): string;

    /**
     * Parse a string path into an object which represents the significant elements of the path.
     *
     * @param string $path
     *
     * @return PathObject
     */
    public static function parse(string $path): PathObject;

    /**
     * Returns the relative path between the `from` and the `to` based on the CWD.
     *
     * If both inputs resolve to the same path, a zero length string is returned.
     * If a zero-length string is used for either input the CWD will be used.
     *
     * @param string $from
     * @param string $to
     *
     * @return string
     */
    public static function relative(string $from, string $to): string;

    /**
     * Resolves a sequence of path segments into an absolute path.
     *
     * If, after processing all given path segments, an absolute path has not been generated, the CWD is used.
     * The resulting path is normalized and trailing slashes are removed unless the path is resolved to the root.
     *
     * Zero-length path segments will be ignored.
     * If no input is provided it will return the absolute path of the current working directory.
     *
     * @param string ...$paths
     *
     * @return string
     */
    public static function resolves(string ...$paths): string;

    /**
     * Returns an equivalent of "namespace-prefixed path" for the given `path`.
     * Intentionally non-operational on POSIX systems - returns unmodified path.
     *
     * @param string $path
     *
     * @return string
     */
    public static function toNamespacedPath(string $path): string;
}
