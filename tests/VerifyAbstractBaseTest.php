<?php

test('verify AbstractPath delimiter', function() {
    $this->expectError();
    $this->expectErrorMessage('Typed static property Astrotomic\Path\AbstractPath::$delimiter must not be accessed before initialization');
    \Astrotomic\Path\AbstractPath::delimiter();
});

test('verify AbstractPath separator', function() {
    $this->expectError();
    $this->expectErrorMessage('Typed static property Astrotomic\Path\AbstractPath::$separator must not be accessed before initialization');
    \Astrotomic\Path\AbstractPath::separator();
});