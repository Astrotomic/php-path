<?php

use \Astrotomic\Path\Path;
use Astrotomic\Path\Posix\Path as PosixPath;

/**
 * Test global basename method.
 *
 * @covers \Astrotomic\Path\Path::basename()
 */
test('that the global basename method works', function (array $input, string $expected) {
    if (count($input) === 2) {
        [$path, $ext] = $input;
    } else {
        $path = $input[0];
        $ext = null;
    }
    expect(Path::basename($path, $ext))
        ->toBeString()
        ->toBe($expected);
})->with([
    [['.php', '.php',], ''],
    [['', ], ''],
    [['/dir/basename.ext', ], 'basename.ext'],
    [['/basename.ext', ], 'basename.ext'],
    [['basename.ext', ], 'basename.ext'],
    [['basename.ext/', ], 'basename.ext'],
    [['basename.ext//', ], 'basename.ext'],
    [['aaa/bbb', '/bbb', ], 'bbb'],
    [['aaa/bbb', 'a/bbb', ], 'bbb'],
    [['aaa/bbb', 'bbb', ], 'bbb'],
    [['aaa/bbb//', 'bbb', ], 'bbb'],
    [['aaa/bbb', 'bb', ], 'b'],
    [['aaa/bbb', 'b', ], 'bb'],
    [['/aaa/bbb', '/bbb', ], 'bbb'],
    [['/aaa/bbb', 'a/bbb', ], 'bbb'],
    [['/aaa/bbb', 'bbb', ], 'bbb'],
    [['/aaa/bbb//', 'bbb', ], 'bbb'],
    [['/aaa/bbb', 'bb', ], 'b'],
    [['/aaa/bbb', 'b', ], 'bb'],
    [['/aaa/bbb', ], 'bbb'],
    [['/aaa/', ], 'aaa'],
    [['/aaa/b', ], 'b'],
    [['/a/b', ], 'b'],
    [['//a', ], 'a'],
    [['a', 'a', ], ''],
]);

/**
 * On Windows a backslash acts as a path separator.
 *
 * @covers \Astrotomic\Path\Win32\Path::basename()
 */
test('the windows basename method', function (array $input, string $expected) {
    if (count($input) === 2) {
        [$path, $ext] = $input;
    } else {
        $path = $input[0];
        $ext = null;
    }
    expect(Path::win32()::basename($path, $ext))
        ->toBeString()
        ->toBe($expected);
})->with([
    [['\\dir\\basename.ext', ], 'basename.ext'],
    [['\\basename.ext', ], 'basename.ext'],
    [['basename.ext', ], 'basename.ext'],
    [['basename.ext\\', ], 'basename.ext'],
    [['basename.ext\\\\', ], 'basename.ext'],
    [['foo', ], 'foo'],
    [['aaa\\bbb', '\\bbb', ], 'bbb'],
    [['aaa\\bbb', 'a\\bbb', ], 'bbb'],
    [['aaa\\bbb', 'bbb', ], 'bbb'],
    [['aaa\\bbb\\\\\\\\', 'bbb', ], 'bbb'],
    [['aaa\\bbb', 'bb', ], 'b'],
    [['aaa\\bbb', 'b', ], 'bb'],
    [['C:', ], ''],
    [['C:.', ], '.'],
    [['C:\\', ], ''],
    [['C:\\dir\\base.ext', ], 'base.ext'],
    [['C:\\basename.ext', ], 'basename.ext'],
    [['C:basename.ext', ], 'basename.ext'],
    [['C:basename.ext\\', ], 'basename.ext'],
    [['C:basename.ext\\\\', ], 'basename.ext'],
    [['C:foo', ], 'foo'],
    [['file:stream', ], 'file:stream'],
    [['a', 'a', ], ''],
]);

/**
 * On unix a backslash is just treated as any other character.
 *
 * @covers \Astrotomic\Path\Posix\Path::basename()
 */
test('Unix backslashes work properly', function (array $input, string $expected) {
    [$path, $ext] = $input;
    expect(Path::posix()::basename($path, $ext))
        ->toBeString()
        ->toBe($expected);
})->with([
    [['\\dir\\basename.ext', ], '\\dir\\basename.ext'],
    [['\\basename.ext', ], '\\basename.ext'],
    [['basename.ext', ], 'basename.ext'],
    [['basename.ext\\', ], 'basename.ext\\'],
    [['basename.ext\\\\', ], 'basename.ext\\\\'],
    [['foo', ], 'foo'],
]);

/**
 * @covers \Astrotomic\Path\Posix\Path::basename()
 */
test('that POSIX filenames may include control characters', function () {
    // POSIX filenames may include control characters
    // c.f. https://dwheeler.com/essays/fixing-unix-linux-filenames.html
    $controlCharacterFilename = 'Icon' . chr(13);
    expect(PosixPath::basename("/a/b/$controlCharacterFilename"))
        ->toBeString()
        ->toBe($controlCharacterFilename);
});
