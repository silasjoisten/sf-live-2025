<?php

declare(strict_types=1);

namespace App\Domain\Value;

use Webmozart\Assert\Assert;

use function Symfony\Component\String\u;

final readonly class Slug
{
    /**
     *  \p{L} → Matches any letter (Latin, Kanji, Hiragana, Katakana, etc.)
     *  \p{N} → Matches any number (so numbers remain valid in slugs)
     *  (?:-[\p{L}\p{N}]+)* → Allows hyphenated words (e.g., hello-world)
     *  (?:\/[\p{L}\p{N}]+(?:-[\p{L}\p{N}]+)*)*\/? → Allows slashes for hierarchical paths
     *  Trailing slash (\/?) → Optional to allow both /slug and /slug/.
     */
    public const string PATTERN = '([\p{L}\p{N}]+(?:-[\p{L}\p{N}]+)*(?:\/[\p{L}\p{N}]+(?:-[\p{L}\p{N}]+)*)*\/?)$';

    public function __construct(
        private string $value,
    ) {
        Assert::stringNotEmpty($value);
        Assert::notWhitespaceOnly($value);
        Assert::regex($value, \sprintf('/%s/', self::PATTERN));
    }

    public function value(string $locale = 'en'): string
    {
        if ('en' === $locale) {
            return $this->value;
        }

        return u($this->value)
            ->trimStart($locale)
            ->trimStart('/')
            ->toString();
    }
}
