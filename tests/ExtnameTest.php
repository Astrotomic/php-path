<?php

dataset('extnameCommonBasics', [
    [__FILE__, '.php'],
    ['', ''],
    ['/path/to/file', ''],
    ['/path/to/file.ext', '.ext'],
    ['/path.to/file.ext', '.ext'],
    ['/path.to/file', ''],
    ['/path.to/.file', ''],
    ['/path.to/.file.ext', '.ext'],
    ['/path/to/f.ext', '.ext'],
    ['/path/to/..ext', '.ext'],
    ['/path/to/..', ''],
    ['file', ''],
    ['file.ext', '.ext'],
    ['.file', ''],
    ['.file.ext', '.ext'],
    ['/file', ''],
    ['/file.ext', '.ext'],
    ['/.file', ''],
    ['/.file.ext', '.ext'],
    ['.path/file.ext', '.ext'],
    ['file.ext.ext', '.ext'],
    ['file.', '.'],
    ['.', ''],
    ['./', ''],
    ['.file.ext', '.ext'],
    ['.file', ''],
    ['.file.', '.'],
    ['.file..', '.'],
    ['..', ''],
    ['../', ''],
    ['..file.ext', '.ext'],
    ['..file', '.file'],
    ['..file.', '.'],
    ['..file..', '.'],
    ['...', '.'],
    ['...ext', '.ext'],
    ['....', '.'],
    ['file.ext/', '.ext'],
    ['file.ext//', '.ext'],
    ['file/', ''],
    ['file//', ''],
    ['file./', '.'],
    ['file.//', '.'],
]);

/**
 * Test the above dataset against both posix and win32 apis...
 * @covers \Astrotomic\Path\Win32\Path::extname()
 */
test('verify general input against Win32 extname method', function (string $input, string $expected) {
    expect(\Astrotomic\Path\Win32\Path::extname($input))->toBeString()->toBe($expected);
})->with('extnameCommonBasics');
/**
 * Test the above dataset against both posix and win32 apis...
 * @covers \Astrotomic\Path\Posixs\Path::extname()
 */
test('verify general input against *nix extname method', function (string $input, string $expected) {
    expect(\Astrotomic\Path\Posix\Path::extname($input))->toBeString()->toBe($expected);
})->with('extnameCommonBasics');

/**
 * @covers \Astrotomic\Path\Win32\Path::extname()
 */
test('that on Windows, backslash is a path separator', function (string $input, string $expected) {
    expect(\Astrotomic\Path\Win32\Path::extname($input))->toBeString()->toBe($expected);
})->with([
    ['.\\', ''],
    ['..\\', ''],
    ['file.ext\\', '.ext'],
    ['file.ext\\\\', '.ext'],
    ['file\\', ''],
    ['file\\\\', ''],
    ['file.\\', '.'],
    ['file.\\\\', '.'],
]);

/**
 * @covers \Astrotomic\Path\Posix\Path::extname()
 */
test('that on *nix, backslash is a valid name component like any other character', function (string $input, string $expected) {
    expect(\Astrotomic\Path\Posix\Path::extname($input))->toBeString()->toBe($expected);
})->with([
    ['.\\', ''],
    ['..\\', '.\\'],
    ['file.ext\\', '.ext\\'],
    ['file.ext\\\\', '.ext\\\\'],
    ['file\\', ''],
    ['file\\\\', ''],
    ['file.\\', '.\\'],
    ['file.\\\\', '.\\\\'],
]);
