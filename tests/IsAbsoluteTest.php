<?php

/**
 * @covers \Astrotomic\Path\Win32\Path::isAbsolute()
 */
test('that win32 isAbsolute provides expected results', function (string $input, bool $expected) {
    expect(\Astrotomic\Path\Win32\Path::isAbsolute($input))->toBeBool()->toBe($expected);
})->with([
    ['/', true],
    ['//', true],
    ['//server', true],
    ['//server/file', true],
    ['\\\\server\\file', true],
    ['\\\\server', true],
    ['\\\\', true],
    ['c', false],
    ['c:', false],
    ['c:\\', true],
    ['c:/', true],
    ['c://', true],
    ['C:/Users/', true],
    ['C:\\Users\\', true],
    ['C:cwd/another', false],
    ['C:cwd\\another', false],
    ['directory/directory', false],
    ['directory\\directory', false],
]);

/**
 * @covers \Astrotomic\Path\Posix\Path::isAbsolute()
 */
test('that *nix isAbsolute provides expected results', function (string $input, bool $expected) {
    expect(\Astrotomic\Path\Posix\Path::isAbsolute($input))->toBeBool()->toBe($expected);
})->with([
    ['/home/foo', true],
    ['/home/foo/..', true],
    ['bar/', false],
    ['./baz', false],
]);