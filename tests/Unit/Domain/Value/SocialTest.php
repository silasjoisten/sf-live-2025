<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Value;

use App\Domain\Value\Social;
use App\Tests\Unit\UnitTestCase;

final class SocialTest extends UnitTestCase
{
    /**
     * @test
     */
    public function icon(): void
    {
        $expected = self::faker()->word();

        self::assertSame($expected, (new Social($expected, self::faker()->sentence()))->icon);
    }

    /**
     * @test
     */
    public function name(): void
    {
        $expected = self::faker()->sentence();

        self::assertSame($expected, (new Social(self::faker()->word(), $expected))->name);
    }
}