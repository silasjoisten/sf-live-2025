<?php

declare(strict_types=1);

namespace App\Domain\Value;

use Webmozart\Assert\Assert;

final readonly class Image
{
    public function __construct(
        public string $url,
        public string $alt,
    ) {
        Assert::stringNotEmpty($url);
        Assert::notWhitespaceOnly($url);
        Assert::startsWith($url, 'http');

        Assert::stringNotEmpty($alt);
        Assert::notWhitespaceOnly($alt);
    }
}
