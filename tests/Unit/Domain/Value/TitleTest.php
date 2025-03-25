<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Value;

use App\Domain\Value\Title;
use App\Tests\Unit\UnitTestCase;

final class TitleTest extends UnitTestCase
{
    /**
     * @test
     */
    public function value(): void
    {
        $expected = self::faker()->sentence();

        self::assertSame($expected, (new Title($expected))->value);
    }

    /**
     * @test
     *
     * @dataProvider invalidValues
     */
    public function invalid(string $value): void
    {
        self::expectException(\InvalidArgumentException::class);

        new Title($value);
    }

    public function invalidValues(): iterable
    {
        yield 'to short' => ['a'];
        yield 'to long' => [self::faker()->realTextBetween(121, 200)];
        yield 'whitespace only' => [' '];
        yield 'empty' => [''];
    }
}