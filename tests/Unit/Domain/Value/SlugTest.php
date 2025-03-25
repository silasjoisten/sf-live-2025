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

        self::assertSame($expected, (new Slug($expected))->value);
    }
}
