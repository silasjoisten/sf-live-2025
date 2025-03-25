<?php

declare(strict_types=1);

namespace App\Domain\Value\Id;

abstract readonly class Id
{
    public function __construct(
        public int $value,
    ) {
    }
}
