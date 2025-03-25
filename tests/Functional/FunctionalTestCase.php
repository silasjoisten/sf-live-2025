<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Faker\Factory;
use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Browser\Test\HasBrowser;
use Zenstruck\Foundry\Test\Factories;

abstract class FunctionalTestCase extends WebTestCase
{
    use Factories;
    use HasBrowser;

    private static ?Generator $faker = null;

    final protected function faker(): Generator
    {
        return self::$faker ??= Factory::create();
    }
}