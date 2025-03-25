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

    /**
     * @test
     */
    public function valuesTypeKeyMustExist(): void
    {
        $values = self::richText();
        unset($values['type']);

        self::expectException(\InvalidArgumentException::class);

        new RichText($values);
    }

    /**
     * @test
     */
    public function valuesContentKeyMustExist(): void
    {
        $values = self::richText();
        unset($values['content']);

        self::expectException(\InvalidArgumentException::class);

        new RichText($values);
    }
}