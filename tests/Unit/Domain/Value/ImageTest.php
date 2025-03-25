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
     */
    public function alt(): void
    {
        $expected = self::faker()->sentence();

        self::assertSame($expected, (new Image(self::faker()->url(), $expected))->alt);
    }
}
