<?php

declare(strict_types=1);

namespace App\Domain\Value;

final readonly class Slug
{
    public function __construct(
        public string $value,
    ) {
    }
}
