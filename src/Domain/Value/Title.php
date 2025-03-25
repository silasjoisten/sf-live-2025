<?php

declare(strict_types=1);

namespace App\Domain\Value;

use Webmozart\Assert\Assert;

final readonly class Title
{
    public function __construct(
        public string $value,
    ) {
        Assert::stringNotEmpty($value);
        Assert::notWhitespaceOnly($value);
        Assert::minLength($value, 5);
        Assert::maxLength($value, 120);
    }
}
