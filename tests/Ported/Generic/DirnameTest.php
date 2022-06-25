<?php

use Astrotomic\Path\Path;

test('verify local file dirname', function () {
    $isWindows = false; // Fix later...
    expect(Path::dirname(__FILE__))
        ->toBeString()
        ->toBe($isWindows ? 'tests\\Generic' : 'tests/Generic');
});
