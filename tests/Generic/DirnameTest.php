<?php

test('verify local file dirname', function () {
    $isWindows = false; // Fix later...
    expect(\Astrotomic\Path\Path::dirname(__FILE__))
        ->toBeString()
        ->toBe($isWindows ? 'tests\\Generic' : 'tests/Generic');
});
