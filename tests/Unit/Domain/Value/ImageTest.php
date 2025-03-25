<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Value;

use App\Domain\Value\Image;
use App\Tests\Unit\UnitTestCase;

final class ImageTest extends UnitTestCase
{
    /**
     * @test
     */
    public function url(): void
    {
        $expected = self::faker()->url();

        self::assertSame($expected, (new Image($expected, self::faker()->sentence()))->url);
    }

    /**
     * @test
     *
     * @dataProvider invalidUrlValues
     */
    public function urlInvalid(string $value): void
    {
        self::expectException(\InvalidArgumentException::class);

        new Image($value, self::faker()->sentence());
    }

    public function invalidUrlValues(): iterable
    {
        yield 'no url' => [self::faker()->word()];
        yield 'whitespace only' => [' '];
        yield 'empty' => [''];
    }

    /**
     * @test
     */
    public function alt(): void
    {
        $expected = self::faker()->sentence();

        self::assertSame($expected, (new Image(self::faker()->url(), $expected))->alt);
    }

    /**
     * @test
     *
     * @dataProvider invalidAltValues
     */
    public function altInvalid(string $value): void
    {
        self::expectException(\InvalidArgumentException::class);

        new Image($value, self::faker()->sentence());
    }

    public function invalidAltValues(): iterable
    {
        yield 'whitespace only' => [' '];
        yield 'empty' => [''];
    }
}