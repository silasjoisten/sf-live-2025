<?php

declare(strict_types=1);

namespace App\Domain\Value;

final readonly class RichText
{
    public function __construct(
        public array $values,
    ) {
    }
}
