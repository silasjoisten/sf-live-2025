<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Value\Id;

use App\Domain\Value\Id\CategoryId;
use App\Tests\Unit\UnitTestCase;

final class CategoryIdTest extends UnitTestCase
{
    /**
     * @test
     */
    public function value(): void
    {
        $expected = self::faker()->numberBetween(1);

        self::assertSame($expected, (new CategoryId($expected))->value);
    }

    /**
     * @test
     */
    public function invalid(): void
    {
        self::expectException(\InvalidArgumentException::class);

        new CategoryId(self::faker()->numberBetween(-5000,0));
    }
}