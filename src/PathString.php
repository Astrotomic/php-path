<?php

declare(strict_types=1);

namespace Astrotomic\Path;

class PathString implements \Stringable
{
    /**
     * @param null|string   $root
     * @param null|string[] $directory
     * @param null|string   $basename
     * @param null|string   $filename
     * @param null|string   $extension
     */
    private function __construct(
        private null|string $root = null,
        private null|array  $directory = null,
        private null|string $basename = null,
        private null|string $filename = null,
        private null|string $extension = null,
        private null|string $separator = null,
    ) {}

    public static function fromString(
        string $path,
        null|string $separator = DIRECTORY_SEPARATOR,
    ): static {
        $root = null; // Default to null for relative paths
        if (!str_starts_with($path, '.')) {
            // On *nix root is always `/`, on windows we fetch drive letter and :
            $root = ($separator === '/') ? '/' : substr($path, 0, 2) . '\\';
        }
        // Special parsing case for Windows.
        if ($separator === "\\") {
            $info = pathinfo(str_replace("\\", "/", $path));
            $info['dirname'] = str_replace("/", "\\", substr($info['dirname'], 2));
        } else {
            $info = pathinfo($path);
        }
        // Remove parsed extension if the input $path ends with a seperator (is folder), or starts with a dot (is dot file/folder).
        $extension = (str_ends_with($path, $separator) || str_starts_with($info['basename'], '.')) ? null : $info['extension'] ?? null;
        // Prepare the directory as an array for internal storage
        $directory = null;
        if ($info['dirname'] !== '') {
            $directory = explode($separator, $info['dirname']);
            $directory = array_filter($directory, function ($value) {
                return $value !== '';
            });
        }
        return new static(
            root: $root,
            directory: $directory,
            basename: $info['basename'] ?: null,
            filename: $info['filename'] ?: null,
            extension: $extension ?: null,
            separator: $separator ?: null,
        );
    }

    public static function make(
        null|string $root = null,
        null|string $directory = null,
        null|string $basename = null,
        null|string $filename = null,
        null|string $extension = null,
        null|string $separator = null,
        null|PathString $from = null,
    ): static {
        if ($separator === null && $from === null) {
            throw new \InvalidArgumentException('Either a `separator` or a `from` must be provided.');
        }
        $separator = $from->separator ?? $separator;
        $directory = $directory !== null ? explode($separator, $directory) : $from->directory ?? null;
        $temp = new static(
            root: $root ?? $from->root ?: null,
            directory: $directory,
            basename: $basename ?? $from->basename ?: null,
            filename: $filename ?? $from->filename ?: null,
            extension: $extension ?? $from->extension ?: null,
            separator: $separator,
        );
        return static::fromString((string) $temp, $separator);
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
        return $this->directory ? implode($this->separator, $this->directory) : null;
    }

    public function getDirectoryStack(): ?array
    {
        return $this->directory;
    }

    public function getBasename(): ?string
    {
        return $this->basename;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function getSeparator(): ?string
    {
        return $this->separator;
    }

    public function __toString(): string
    {
        $prepend = $this->root ?: '';
        return $prepend . implode($this->separator, array_filter([
            ...$this->directory,
            $this->basename,
        ], function ($value) {
            return $value !== null;
        }));
    }
}