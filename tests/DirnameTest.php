<?php

test('basic *nix dirname tests', function () {

})->with([
    ['/a/b/', '/a',],
    ['/a/b', '/a',],
    ['/a', '/',],
    ['', '.',],
    ['/', '/',],
    ['////', '/',],
    ['//a', '//',],
    ['foo', '.',],
]);

// On Windows a backslash acts as a path separator.
// Test against windows methods...
dataset('dirnamesWindowsBasics', [
    ['c:\\', 'c:\\',],
    ['c:\\foo', 'c:\\',],
    ['c:\\foo\\', 'c:\\',],
    ['c:\\foo\\bar', 'c:\\foo',],
    ['c:\\foo\\bar\\', 'c:\\foo',],
    ['c:\\foo\\bar\\baz', 'c:\\foo\\bar',],
    ['c:\\foo bar\\baz', 'c:\\foo bar',],
    ['\\', '\\',],
    ['\\foo', '\\',],
    ['\\foo\\', '\\',],
    ['\\foo\\bar', '\\foo',],
    ['\\foo\\bar\\', '\\foo',],
    ['\\foo\\bar\\baz', '\\foo\\bar',],
    ['\\foo bar\\baz', '\\foo bar',],
    ['c:', 'c:',],
    ['c:foo', 'c:',],
    ['c:foo\\', 'c:',],
    ['c:foo\\bar', 'c:foo',],
    ['c:foo\\bar\\', 'c:foo',],
    ['c:foo\\bar\\baz', 'c:foo\\bar',],
    ['c:foo bar\\baz', 'c:foo bar',],
    ['file:stream', '.',],
    ['dir\\file:stream', 'dir',],
    ['\\\\unc\\share', '\\\\unc\\share',],
    ['\\\\unc\\share\\foo', '\\\\unc\\share\\',],
    ['\\\\unc\\share\\foo\\', '\\\\unc\\share\\',],
    ['\\\\unc\\share\\foo\\bar', '\\\\unc\\share\\foo',],
    ['\\\\unc\\share\\foo\\bar\\', '\\\\unc\\share\\foo',],
    ['\\\\unc\\share\\foo\\bar\\baz', '\\\\unc\\share\\foo\\bar',],
    ['/a/b/', '/a',],
    ['/a/b', '/a',],
    ['/a', '/',],
    ['', '.',],
    ['/', '/',],
    ['////', '/',],
    ['foo', '.',],
]);

