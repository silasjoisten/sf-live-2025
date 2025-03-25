<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Value;

use App\Domain\Value\RichText;
use App\Tests\Unit\UnitTestCase;

final class RichTextTest extends UnitTestCase
{
    /**
     * @test
     */
    public function values(): void
    {
        $values = self::richText();

        self::assertSame($values, (new RichText($values))->values);
    }
}
