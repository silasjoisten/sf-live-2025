<?php

declare(strict_types=1);

namespace App\Factory;

use Symfony\Component\String\Slugger\AsciiSlugger;
use Zenstruck\Foundry\ArrayFactory;

final class PostFactory extends ArrayFactory
{
    protected function defaults(): array
    {
        $title = self::faker()->sentence();

        return [
            'id' => self::faker()->numberBetween(1),
            'full_slug' => sprintf('blog/%s', (new AsciiSlugger())->slug($title)->lower()->toString()),
            'content' => [
                'title' => $title,
                'description' => self::faker()->text(),
                'image' => [
                    'filename' => sprintf('https://picsum.photos/seed/%d/640/480', self::faker()->randomNumber()),
                    'alt' => self::faker()->sentence(),
                ],
                'author' => AuthorFactory::createMany(1),
                'category' => CategoryFactory::createMany(1),
                'content' => [
                    'type' => 'doc',
                    'content' => [
                        [
                            'type' => 'paragraph',
                            'content' => [
                                [
                                    'text' => self::faker()->sentence(),
                                    'type' => 'text',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
