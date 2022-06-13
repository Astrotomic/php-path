<?php

test('can properly parse and then format paths with *nix', function(string $element, string $expectedRoot) {
    $output = \Astrotomic\Path\Posix\Path::parse($element);
    // Verify types of path object components.
    // TODO: fix the PathObject::class so that these can be nullable for delineating unset vs empty ''.
    expect($output->root)->toBeString();
    expect($output->dir)->toBeString();
    expect($output->base)->toBeString();
    expect($output->ext)->toBeString();
    expect($output->name)->toBeString();
    // Verify the object can be rendered back to the same string.
    expect(Astrotomic\Path\Posix\Path::format($output))->toBeString()->toBe($element);
    // Verify the PathObjects root value - after type and format, same as port lib.
    expect($output->root)->toBe($expectedRoot);
    expect($output->dir)->toBe($output->dir ? \Astrotomic\Path\Posix\Path::dirname($element) : '');
    expect($output->base)->toBe(\Astrotomic\Path\Posix\Path::basename($element));
    expect($output->ext)->toBe(\Astrotomic\Path\Posix\Path::extname($element));
})->with([
    // [path, root]
    ['/home/user/dir/file.txt', '/'],
    ['/home/user/a dir/another File.zip', '/'],
    ['/home/user/a dir//another&File.', '/'],
    ['/home/user/a$$$dir//another File.zip', '/'],
    ['user/dir/another File.zip', ''],
    ['file', ''],
    ['.\\file', ''],
    ['./file', ''],
    ['C:\\foo', ''],
    ['/', '/'],
    ['', ''],
    ['.', ''],
    ['..', ''],
    ['/foo', '/'],
    ['/foo.', '/'],
    ['/foo.bar', '/'],
    ['/.', '/'],
    ['/.foo', '/'],
    ['/.foo.bar', '/'],
    ['/foo/bar.baz', '/'],
]);

test('can properly parse and then format paths with Win32', function(string $element, string $expectedRoot) {
    $output = \Astrotomic\Path\Win32\Path::parse($element);
    // Verify types of path object components.
    // TODO: fix the PathObject::class so that these can be nullable for delineating unset vs empty ''.
    expect($output->root)->toBeString();
    expect($output->dir)->toBeString();
    expect($output->base)->toBeString();
    expect($output->ext)->toBeString();
    expect($output->name)->toBeString();
    // Verify the object can be rendered back to the same string.
    expect(Astrotomic\Path\Win32\Path::format($output))->toBeString()->toBe($element);
    // Verify the PathObjects root value - after type and format, same as port lib.
    expect($output->root)->toBe($expectedRoot);
    expect($output->dir)->toBe($output->dir ? \Astrotomic\Path\Win32\Path::dirname($element) : '');
    expect($output->base)->toBe(\Astrotomic\Path\Win32\Path::basename($element));
    expect($output->ext)->toBe(\Astrotomic\Path\Win32\Path::extname($element));
})->with([
    // [path, root]
    ['C:\\path\\dir\\index.html', 'C:\\'],
    ['C:\\another_path\\DIR\\1\\2\\33\\\\index', 'C:\\'],
    ['another_path\\DIR with spaces\\1\\2\\33\\index', ''],
    ['\\', '\\'],
    ['\\foo\\C:', '\\'],
    ['file', ''],
    ['file:stream', ''],
    ['.\\file', ''],
    ['C:', 'C:'],
    ['C:.', 'C:'],
    ['C:..', 'C:'],
    ['C:abc', 'C:'],
    ['C:\\', 'C:\\'],
    ['C:\\abc', 'C:\\' ],
    ['', ''],

    // unc
    ['\\\\server\\share\\file_path', '\\\\server\\share\\'],
    ['\\\\server two\\shared folder\\file path.zip',
        '\\\\server two\\shared folder\\'],
    ['\\\\teela\\admin$\\system32', '\\\\teela\\admin$\\'],
    ['\\\\?\\UNC\\server\\share', '\\\\?\\UNC\\'],
]);

test('ensure special win32 paths parse', function(string $element, \Astrotomic\Path\PathObject $expected) {
    expect(\Astrotomic\Path\Win32\Path::parse($element))->toBeObject()->toBe($element);
})->with([
    ['t', new \Astrotomic\Path\PathObject(base: 't', name: 't', root: '', dir: '', ext: '')],
    ['/foo/bar', new \Astrotomic\Path\PathObject(root: '/', dir: '/foo', base: 'bar', ext: '', name: 'bar')],
]);

test('ensure special win32 paths format', function(\Astrotomic\Path\PathObject $element, string $expected) {
    expect(\Astrotomic\Path\Win32\Path::format($element))->toBe($element);
})->with([
    [new \Astrotomic\Path\PathObject(dir: 'some\\dir'), 'some\\dir\\'],
    [new \Astrotomic\Path\PathObject(base: 'index.html'), 'index.html'],
    [new \Astrotomic\Path\PathObject(root: 'C:\\'), 'C:\\'],
    [new \Astrotomic\Path\PathObject(name: 'index', ext: '.html'), 'index.html'],
    [new \Astrotomic\Path\PathObject(dir: 'some\\dir', name: 'index', ext: '.html'), 'some\\dir\\index.html'],
    [new \Astrotomic\Path\PathObject(root: 'C:\\', name: 'index', ext: '.html'), 'C:\\index.html'],
    [new \Astrotomic\Path\PathObject(), ''],
]);

test('ensure special *nix paths format', function(\Astrotomic\Path\PathObject $element, string $expected) {
    expect(\Astrotomic\Path\Posix\Path::format($element))->toBe($element);
})->with([
    [new \Astrotomic\Path\PathObject(dir: 'some/dir'), 'some/dir/'],
    [new \Astrotomic\Path\Path(base: 'index.html'), 'index.html'],
    [new \Astrotomic\Path\PathObject(root: '/'), '/'],
    [new \Astrotomic\Path\PathObject(name: 'index', ext: '.html'), 'index.html'],
    [new \Astrotomic\Path\PathObject(dir: 'some/dir', name: 'index', ext: '.html'), 'some/dir/index.html'],
    [new \Astrotomic\Path\PathObject(root: '/', name: 'index', ext: '.html'), '/index.html'],
    [new \Astrotomic\Path\PathObject(), ''],
]);