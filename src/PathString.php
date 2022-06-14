<?php

declare(strict_types=1);

namespace Astrotomic\Path;

class PathString implements \Stringable
{
    private function __construct(
        private null|string $root = null,
        private null|string $directory = null,
        private null|string $base = null,
        private null|string $name = null,
        private null|string $extension = null,
    ) {}

    public static function make(
        null|string $root = null,
        null|string $directory = null,
        null|string $base = null,
        null|string $name = null,
        null|string $extension = null,
        null|PathString $from = null,
    ): static {
        return new static(
            root: $from->root ?? $root ?: null,
            directory: $from->directory ?? $directory ?: null,
            base: $from->base ?? $base ?: null,
            name: $from->name ?? $name ?: null,
            extension: $from->extension ?? $extension ?: null,
        );
    }

    public function isAbsolute(): bool
    {
        return $this->root !== null;
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


    public function __toString(): string
    {
        return implode(DIRECTORY_SEPARATOR, array_filter([
            $this->directory,
            $this->base,
        ], function ($value) {
            return $value !== null;
        }));
    }
}