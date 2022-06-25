<?php

use Astrotomic\Path\AbstractPath;

test('verify AbstractPath delimiter', function() {
    $this->expectError();
    $this->expectErrorMessage('Typed static property Astrotomic\Path\AbstractPath::$delimiter must not be accessed before initialization');
    AbstractPath::delimiter();
});

test('verify AbstractPath separator', function() {
    $this->expectError();
    $this->expectErrorMessage('Typed static property Astrotomic\Path\AbstractPath::$separator must not be accessed before initialization');
    AbstractPath::separator();
});
