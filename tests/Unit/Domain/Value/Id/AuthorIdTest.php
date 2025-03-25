<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Value\Id;

use App\Domain\Value\Id\AuthorId;
use App\Tests\Unit\UnitTestCase;

final class AuthorIdTest extends UnitTestCase
{
    /**
     * @test
     */
    public function value(): void
    {
        $expected = self::faker()->numberBetween(1);

        self::assertSame($expected, (new AuthorId($expected))->value);
    }

    /**
     * @test
     */
    public function invalid(): void
    {
        self::expectException(\InvalidArgumentException::class);

        new AuthorId(self::faker()->numberBetween(-5000,0));
    }
}