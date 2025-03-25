<?php

declare(strict_types=1);

namespace App\Domain\Value\Id;

use Webmozart\Assert\Assert;

abstract readonly class Id
{
    public function __construct(
        public int $value,
    ) {
        Assert::greaterThan($value, 0);
    }
}
