<?php

declare(strict_types=1);

namespace App\Factory;

use Symfony\Component\String\Slugger\AsciiSlugger;
use Zenstruck\Foundry\ArrayFactory;

final class AuthorFactory extends ArrayFactory
{
    protected function defaults(): array
    {
        $socials = [];

        for ($i = 1; $i <= self::faker()->numberBetween(1,3); $i++) {
            $socials[] = [
                'name' => self::faker()->sentence(),
                'icon' => self::faker()->word(),
            ];
        }

        $name = self::faker()->name();

        return [
            'id' => self::faker()->numberBetween(1),
            'full_slug' => sprintf('blog/authors/%s', (new AsciiSlugger())->slug($name)->lower()->toString()),
            'content' => [
                'name' => $name,
                'bio' => self::faker()->text(),
                'socials' => $socials,
            ],
        ];
    }
}