<?php

use Astrotomic\Path\Posix\Path as PosixPath;
use Astrotomic\Path\Win32\Path as WinPath;

test('verify Win32 resolves path transform tests', function(array $pathParts, string $expected) {
    expect(WinPath::resolves(...$pathParts))
        ->toBeString()
        ->toBe($expected);
})->with([
    [['c:/blah\\blah', 'd:/games', 'c:../a'], 'c:\\blah\\a'],
    [['c:/ignore', 'd:\\a/b\\c/d', '\\e.exe'], 'd:\\e.exe'],
    [['c:/ignore', 'c:/some/file'], 'c:\\some\\file'],
    [['d:/ignore', 'd:some/dir//'], 'd:\\ignore\\some\\dir'],
    [['.'], getcwd()],
    [['//server/share', '..', 'relative\\'], '\\\\server\\share\\relative'],
    [['c:/', '//'], 'c:\\'],
    [['c:/', '//dir'], 'c:\\dir'],
    [['c:/', '//server/share'], '\\\\server\\share\\'],
    [['c:/', '//server//share'], '\\\\server\\share\\'],
    [['c:/', '///some//dir'], 'c:\\some\\dir'],
    [['C:\\foo\\tmp.3\\', '..\\tmp.3\\cycles\\root.js'],
        'C:\\foo\\tmp.3\\cycles\\root.js'],
]);

test('verify *nix resolves path transform tests', function(array $pathParts, string $expected) {
    expect(PosixPath::resolves(...$pathParts))
        ->toBeString()
        ->toBe($expected);
})->with([
    [['/var/lib', '../', 'file/'], '/var/file'],
    [['/var/lib', '/../', 'file/'], '/file'],
    [['a/b/c/', '../../..'], getcwd()],
    [['.'], getcwd()],
    [['/some/dir', '.', '/absolute/'], '/absolute'],
    [['/foo/tmp.3/', '../tmp.3/cycles/root.js'], '/foo/tmp.3/cycles/root.js'],
]);