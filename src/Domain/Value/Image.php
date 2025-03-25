<?php

declare(strict_types=1);

namespace App\Domain\Value;

final readonly class Image
{
    public function __construct(
        public string $url,
        public string $alt,
    ) {
    }
}
