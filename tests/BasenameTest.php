<?php

use \Astrotomic\Path\Path;

// On Windows a backslash acts as a path separator.
// Test against windows methods...
test('the windows basename method', function (array $input, string $expected) {
    if (count($input) === 2) {
        [$path, $ext] = $input;
    } else {
        $path = $input[0];
        $ext = null;
    }
    expect(Path::win32()::basename($path, $ext))->toBeString()->toBe($expected);
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

// On unix a backslash is just treated as any other character.
// Test against POSIX methods...
test('Unix backslashes work properly', function (array $input, string $expected) {
    [$path, $ext] = $input;
    expect(Path::posix()::basename($path, $ext))->toBeString()->toBe($expected);
})->with([
    [['\\dir\\basename.ext', ], '\\dir\\basename.ext'],
    [['\\basename.ext', ], '\\basename.ext'],
    [['basename.ext', ], 'basename.ext'],
    [['basename.ext\\', ], 'basename.ext\\'],
    [['basename.ext\\\\', ], 'basename.ext\\\\'],
    [['foo', ], 'foo'],
]);

test('that POSIX filenames may include control characters', function () {
    // POSIX filenames may include control characters
    // c.f. https://dwheeler.com/essays/fixing-unix-linux-filenames.html
    // TODO: PORT THIS CODE
    $controlCharacterFilename = 'Icon' . chr(13);
    expect(\Astrotomic\Path\Posix\Path::basename("/a/b/$controlCharacterFilename"))->toBeString()->toBe($controlCharacterFilename);
});
