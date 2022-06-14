<?php

declare(strict_types=1);

namespace Astrotomic\Path;

class PathObject
{
    public function __construct(
        public null|string $dir = null,
        public null|string $root = null,
        public null|string $base = null,
        public null|string $name = null,
        public null|string $ext = null,
    ) {}
}
