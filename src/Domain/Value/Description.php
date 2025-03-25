<?php

declare(strict_types=1);

namespace App\Domain\Value;

use Webmozart\Assert\Assert;

final readonly class Description
{
    public function __construct(
        public string $value,
    ) {
        Assert::stringNotEmpty($value);
        Assert::notWhitespaceOnly($value);
        Assert::minLength($value, 20);
        Assert::maxLength($value, 200);
    }
}
