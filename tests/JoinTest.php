<?php

dataset('generalJoinData', [
    [['.', 'x/b', '..', '/b/c.js'], 'x/b/c.js'],
    [[], '.'],
    [['/.', 'x/b', '..', '/b/c.js'], '/x/b/c.js'],
    [['/foo', '../../../bar'], '/bar'],
    [['foo', '../../../bar'], '../../bar'],
    [['foo/', '../../../bar'], '../../bar'],
    [['foo/x', '../../../bar'], '../bar'],
    [['foo/x', './bar'], 'foo/x/bar'],
    [['foo/x/', './bar'], 'foo/x/bar'],
    [['foo/x/', '.', 'bar'], 'foo/x/bar'],
    [['./'], './'],
    [['.', './'], './'],
    [['.', '.', '.'], '.'],
    [['.', './', '.'], '.'],
    [['.', '/./', '.'], '.'],
    [['.', '/////./', '.'], '.'],
    [['.'], '.'],
    [['', '.'], '.'],
    [['', 'foo'], 'foo'],
    [['foo', '/bar'], 'foo/bar'],
    [['', '/foo'], '/foo'],
    [['', '', '/foo'], '/foo'],
    [['', '', 'foo'], 'foo'],
    [['foo', ''], 'foo'],
    [['foo/', ''], 'foo/'],
    [['foo', '', '/bar'], 'foo/bar'],
    [['./', '..', '/foo'], '../foo'],
    [['./', '..', '..', '/foo'], '../../foo'],
    [['.', '..', '..', '/foo'], '../../foo'],
    [['', '..', '..', '/foo'], '../../foo'],
    [['/'], '/'],
    [['/', '.'], '/'],
    [['/', '..'], '/'],
    [['/', '..', '..'], '/'],
    [[''], '.'],
    [['', ''], '.'],
    [[' /foo'], ' /foo'],
    [[' ', 'foo'], ' /foo'],
    [[' ', '.'], ' '],
    [[' ', '/'], ' /'],
    [[' ', ''], ' '],
    [['/', 'foo'], '/foo'],
    [['/', '/foo'], '/foo'],
    [['/', '//foo'], '/foo'],
    [['/', '', '/foo'], '/foo'],
    [['', '/', 'foo'], '/foo'],
    [['', '/', '/foo'], '/foo'],
]);

test('verify *nix join works', function(array $parts, string $expeccted) {
    expect(\Astrotomic\Path\Posix\Path::join(...$parts))->toBeString()->toBe($expeccted);
})->with('generalJoinData');

dataset('windowsSpecificData', [
    // Arguments                     result
    // UNC path expected
    [['//foo/bar'], '\\\\foo\\bar\\'],
    [['\\/foo/bar'], '\\\\foo\\bar\\'],
    [['\\\\foo/bar'], '\\\\foo\\bar\\'],
    // UNC path expected - server and share separate
    [['//foo', 'bar'], '\\\\foo\\bar\\'],
    [['//foo/', 'bar'], '\\\\foo\\bar\\'],
    [['//foo', '/bar'], '\\\\foo\\bar\\'],
    // UNC path expected - questionable
    [['//foo', '', 'bar'], '\\\\foo\\bar\\'],
    [['//foo/', '', 'bar'], '\\\\foo\\bar\\'],
    [['//foo/', '', '/bar'], '\\\\foo\\bar\\'],
    // UNC path expected - even more questionable
    [['', '//foo', 'bar'], '\\\\foo\\bar\\'],
    [['', '//foo/', 'bar'], '\\\\foo\\bar\\'],
    [['', '//foo/', '/bar'], '\\\\foo\\bar\\'],
    // No UNC path expected (no double slash in first component)
    [['\\', 'foo/bar'], '\\foo\\bar'],
    [['\\', '/foo/bar'], '\\foo\\bar'],
    [['', '/', '/foo/bar'], '\\foo\\bar'],
    // No UNC path expected (no non-slashes in first component -
    // questionable)
    [['//', 'foo/bar'], '\\foo\\bar'],
    [['//', '/foo/bar'], '\\foo\\bar'],
    [['\\\\', '/', '/foo/bar'], '\\foo\\bar'],
    [['//'], '\\'],
    // No UNC path expected (share name missing - questionable).
    [['//foo'], '\\foo'],
    [['//foo/'], '\\foo\\'],
    [['//foo', '/'], '\\foo\\'],
    [['//foo', '', '/'], '\\foo\\'],
    // No UNC path expected (too many leading slashes - questionable)
    [['///foo/bar'], '\\foo\\bar'],
    [['////foo', 'bar'], '\\foo\\bar'],
    [['\\\\\\/foo/bar'], '\\foo\\bar'],
    // Drive-relative vs drive-absolute paths. This merely describes the
    // status quo, rather than being obviously right
    [['c:'], 'c:.'],
    [['c:.'], 'c:.'],
    [['c:', ''], 'c:.'],
    [['', 'c:'], 'c:.'],
    [['c:.', '/'], 'c:.\\'],
    [['c:.', 'file'], 'c:file'],
    [['c:', '/'], 'c:\\'],
    [['c:', 'file'], 'c:\\file'],
]);

test('verify Win32 join works', function(array $parts, string $expeccted) {
    expect(\Astrotomic\Path\Win32\Path::join(...$parts))->toBeString()->toBe($expeccted);
})->with('generalJoinData', 'windowsSpecificData');