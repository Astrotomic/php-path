<?php

/**
 * @covers \Astrotomic\Path\Path::toNamespacedPath()
 */
test('verify NOOP for toNamespacedPath on any platform', function(string $input, string $expected) {
    expect(\Astrotomic\Path\Path::toNamespacedPath($input))->toBe($expected);
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
    expect(\Astrotomic\Path\Posix\Path::toNamespacedPath($input))->toBe($expected);
})->with([
    ['/foo/bar', '/foo/bar'],
    ['foo/bar', 'foo/bar'],
    ['null', 'null'],
    ['true', 'true'],
    ['1', '1'],
]);