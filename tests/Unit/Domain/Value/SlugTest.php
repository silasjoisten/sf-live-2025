<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Value;

use App\Domain\Value\Slug;
use App\Tests\Unit\UnitTestCase;

final class SlugTest extends UnitTestCase
{
    /**
     * @test
     */
    public function value(): void
    {
        $expected = self::faker()->word();

        self::assertSame($expected, (new Slug($expected))->value());
    }

    /**
     * @test
     */
    public function valueWithParameter(): void
    {
        self::assertSame('blog/foo-bar', (new Slug('de/blog/foo-bar'))->value('de'));
    }

    /**
     * @test
     *
     * @dataProvider invalidValues
     */
    public function invalid(string $value): void
    {
        self::expectException(\InvalidArgumentException::class);

        new Slug($value);
    }

    public function invalidValues(): iterable
    {
        yield 'whitespace only' => [' '];
        yield 'empty' => [''];
        yield 'invalid chars in valid text' => ['Привіт, світ!'];
        yield 'invalid slug chars' => [':-'];
    }
}
