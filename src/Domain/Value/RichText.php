<?php

declare(strict_types=1);

namespace App\Domain\Value;

use Webmozart\Assert\Assert;

final readonly class RichText
{
    public function __construct(
        public array $values,
    ) {
        Assert::keyExists($values, 'type');
        Assert::same($values['type'], 'doc');

        Assert::keyExists($values, 'content');
    }
}
