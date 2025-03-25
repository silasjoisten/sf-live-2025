<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

abstract class UnitTestCase extends TestCase
{
    use Factories;

    private static ?Generator $faker = null;

    final static protected function faker(): Generator
    {
        return self::$faker ??= Factory::create();
    }

    /**
     * @return array{
     *     type: string,
     *     content: array
     * }
     */
    final static protected function richText(): array
    {
        return [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'text' => self::faker()->sentence(),
                            'type' => 'text'
                        ]
                    ]
                ]
            ]
        ];
    }
}