<?php

declare(strict_types=1);

namespace App\Domain\Value;

final readonly class Social
{
    public function __construct(
        public string $icon,
        public string $name,
    ) {
    }
}
