<?php


use Astrotomic\Path\Path;
use Astrotomic\Path\Posix\Path as PosixPath;
use Astrotomic\Path\Win32\Path as WinPath;

if (Path::isWindows()) {
    test('Windows only tests - verify UNC paths', function (string $input, string $expected) {
        expect(WinPath::toNamespacedPath($input))
            ->toBeString()
            ->toBe($expected);
    })->with([
        ['\\\\someserver\\someshare\\somefile', '\\\\?\\UNC\\someserver\\someshare\\somefile'],
        ['\\\\?\\UNC\\someserver\\someshare\\somefile', '\\\\?\\UNC\\someserver\\someshare\\somefile'],
        ['\\\\.\\pipe\\somepipe', '\\\\.\\pipe\\somepipe'],
    ]);
}

/**
 * @covers \Astrotomic\Path\Path::toNamespacedPath()
 */
test('verify NOOP for toNamespacedPath on any platform', function(string $input, string $expected) {
    expect(Path::toNamespacedPath($input))->toBe($expected);
})->with([
    ['', ''],
    ['null', 'null'],
    ['true', 'true'],
    ['1', '1'],
]);

/**
 * @covers \Astrotomic\Path\Posix\Path::toNamespacedPath()
 */
test('verify *nix runs NOOP for toNamespacedPath', function(string $input, string $expected) {
    expect(PosixPath::toNamespacedPath($input))->toBe($expected);
})->with([
    ['/foo/bar', '/foo/bar'],
    ['foo/bar', 'foo/bar'],
    ['null', 'null'],
    ['true', 'true'],
    ['1', '1'],
]);

if (Path::isWindows()) {
    // NOTE: OG notes from node.js follow, may not apply here as we define logic...
    // These tests cause resolve() to insert the cwd, so we cannot test them from
    // non-Windows platforms (easily)
    test('Windows only tests - buggy resolve paths', function() {
        $expectedFooBar = strtolower(getcwd());
        $currentDeviceLetter = substr(Path::parse(getcwd())->root, 0, 2);

        expect(Path::toNamespacedPath(''))
            ->toBeString()
            ->toBe('')
            ->and(strtolower(WinPath::toNamespacedPath('foo\\bar')))
            ->toBeString()
            ->toBe("\\\\?\\$expectedFooBar\\foo\\bar")
            ->and(strtolower(WinPath::toNamespacedPath('foo/bar')))
            ->toBeString()
            ->toBe("\\\\?\\$expectedFooBar\\foo\\bar")
            ->and(strtolower(WinPath::toNamespacedPath($currentDeviceLetter)))
            ->toBeString()
            ->toBe("\\\\?\\$expectedFooBar")
            ->and(strtolower(WinPath::toNamespacedPath('C')))
            ->toBeString()
            ->toBe("\\\\?\\$expectedFooBar")
        ;
    });
}

test('ensure Win32 toNamespacedpath works on all platforms', function(string $input, string $expected) {
    expect(WinPath::toNamespacedPath($input))
        ->toBeString()
        ->toBe($expected);
})->with([
    ['C:\\foo', '\\\\?\\C:\\foo',],
    ['C:/foo', '\\\\?\\C:\\foo',],
    ['\\\\foo\\bar', '\\\\?\\UNC\\foo\\bar\\',],
    ['//foo//bar', '\\\\?\\UNC\\foo\\bar\\',],
    ['\\\\?\\foo', '\\\\?\\foo',],
    ['true', 'true',],
    ['1', '1',],
]);