<?php

use Astrotomic\Path\PathString;

test('verify we can make instance of PathString from windows path', function() {
    $path = "C:\\foo\\bar\\";
    $pathString = PathString::fromString($path, "\\");
    expect((string) $pathString)->toBe(rtrim($path, "\\"));

    $path = "C:\\foo\\bar\\baz";
    $pathString = PathString::fromString($path, "\\");
    expect((string) $pathString)->toBe($path);
});

test('verify we can make instance of PathString from *nix path', function() {
    $path = "/c/foo/bar/";
    $pathString = PathString::fromString($path, "/");
    expect((string) $pathString)->toBe(rtrim($path, "/"));

    $path = "/var/foo/bar/baz";
    $pathString = PathString::fromString($path, "/");
    expect((string) $pathString)->toBe($path);
});

test('verify we can modify *nix path via make method', function() {
    $path = "/var/foo/bar/";
    $pathString = PathString::fromString($path, "/");
    expect((string) $pathString)->toBe(rtrim($path, "/"));
    $newPathString = PathString::make(from: $pathString, basename: "/bar/baz/");
    expect((string) $newPathString)->toBe("/var/foo/bar/baz");
});

test('verify we can modify windows path via make method', function() {
    $path = "C:\\foo\\bar\\";
    $pathString = PathString::fromString($path, "\\");
    expect((string) $pathString)->toBe(rtrim($path, "\\"));
    $newPathString = PathString::make(from: $pathString, basename: "\\bar\\baz\\");
    expect((string) $newPathString)->toBe("C:\\foo\\bar\\baz");
});