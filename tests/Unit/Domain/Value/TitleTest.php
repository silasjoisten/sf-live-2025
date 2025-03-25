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
}
