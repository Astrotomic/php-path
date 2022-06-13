<?php

declare(strict_types=1);

namespace Astrotomic\Path;

class PathString
{
    private function __construct(
        private null|string $root = null,
        private null|string $directory = null,
        private null|string $base = null,
        private null|string $name = null,
        private null|string $extension = null,
    ) {}

    public static function fromString(string $path): PathString
    {
        $info = pathinfo($path);
        $root = null;
        if (!str_starts_with($info['dirname'], '.')) {
            $root = Path::isWindows() ? substr($info['dirname'], 0, 2) : '/';
        }
        return static::make(
            root: $root,
            directory: $info['dirname'],
            base: $info['basename'],
            name: $info['filename'],
            extension: $info['extension'],
        );
    }

    public static function make(
        null|string $root = null,
        null|string $directory = null,
        null|string $base = null,
        null|string $name = null,
        null|string $extension = null,
        null|PathString $from = null,
    ) {
        return new static(
            root: $from->root ?? $root,
            directory: $from->directory ?? $directory,
            base: $from->base ?? $base,
            name: $from->name ?? $name,
            extension: $from->extension ?? $extension,
        );
    }
    
    public function getRoot(): ?string
    {
        return $this->root;
    }

    public function getDirectory(): ?string
    {
        return $this->directory;
    }

    public function getBase(): ?string
    {
        return $this->base;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }
}