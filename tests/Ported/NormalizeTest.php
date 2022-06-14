<?php

use Astrotomic\Path\Posix\Path as PosixPath;
use Astrotomic\Path\Win32\Path as WinPath;

test('verify basic Win32 normalize', function (string $input, string $expected) {
    expect(WinPath::normalize($input))
        ->toBeString()
        ->toBe($expected);
})->with([
    ['./fixtures///b/../b/c.js', 'fixtures\\b\\c.js',],
    ['/foo/../../../bar', '\\bar',],
    ['a//b//../b', 'a\\b',],
    ['a//b//./c', 'a\\b\\c',],
    ['a//b//.', 'a\\b',],
    ['//server/share/dir/file.ext', '\\\\server\\share\\dir\\file.ext',],
    ['/a/b/c/../../../x/y/z', '\\x\\y\\z',],
    ['C:', 'C:.',],
    ['C:..\\abc', 'C:..\\abc',],
    ['C:..\\..\\abc\\..\\def', 'C:..\\..\\def',],
    ['C:\\.', 'C:\\',],
    ['file:stream', 'file:stream',],
    ['bar\\foo..\\..\\', 'bar\\',],
    ['bar\\foo..\\..', 'bar',],
    ['bar\\foo..\\..\\baz', 'bar\\baz',],
    ['bar\\foo..\\', 'bar\\foo..\\',],
    ['bar\\foo..', 'bar\\foo..',],
    ['..\\foo..\\..\\..\\bar', '..\\..\\bar',],
    ['..\\...\\..\\.\\...\\..\\..\\bar', '..\\..\\bar',],
    ['../../../foo/../../../bar', '..\\..\\..\\..\\..\\bar',],
    ['../../../foo/../../../bar/../../', '..\\..\\..\\..\\..\\..\\',],
    ['../foobar/barfoo/foo/../../../bar/../../', '..\\..\\'],
    ['../.../../foobar/../../../bar/../../baz', '..\\..\\..\\..\\baz'],
    ['foo/bar\\baz', 'foo\\bar\\baz',],
]);

test('verify basic *nix normalize', function (string $input, string $expected) {
    expect(PosixPath::normalize($input))
        ->toBeString()
        ->toBe($expected);
})->with([
    ['./fixtures///b/../b/c.js', 'fixtures/b/c.js',],
    ['/foo/../../../bar', '/bar',],
    ['a//b//../b', 'a/b',],
    ['a//b//./c', 'a/b/c',],
    ['a//b//.', 'a/b',],
    ['/a/b/c/../../../x/y/z', '/x/y/z',],
    ['///..//./foo/.//bar', '/foo/bar',],
    ['bar/foo../../', 'bar/',],
    ['bar/foo../..', 'bar',],
    ['bar/foo../../baz', 'bar/baz',],
    ['bar/foo../', 'bar/foo../',],
    ['bar/foo..', 'bar/foo..',],
    ['../foo../../../bar', '../../bar',],
    ['../.../.././.../../../bar', '../../bar',],
    ['../../../foo/../../../bar', '../../../../../bar',],
    ['../../../foo/../../../bar/../../', '../../../../../../',],
    ['../foobar/barfoo/foo/../../../bar/../../', '../../'],
    ['../.../../foobar/../../../bar/../../baz', '../../../../baz'],
    ['foo/bar\\baz', 'foo/bar\\baz',],
]);