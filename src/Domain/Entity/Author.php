<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Value\Id\AuthorId;
use App\Domain\Value\Slug;
use App\Domain\Value\Social;
use Webmozart\Assert\Assert;

final readonly class Author
{
    public AuthorId $id;
    public Slug $slug;
    public string $name;
    public string $bio;
    public array $socials;

    public function __construct(array $values)
    {
        Assert::keyExists($values, 'id');
        $this->id = new AuthorId($values['id']);

        Assert::keyExists($values, 'full_slug');
        $this->slug = new Slug($values['full_slug']);

        Assert::keyExists($values, 'content');
        $values = $values['content'];

        Assert::keyExists($values, 'name');
        $this->name = $values['name'];

        Assert::keyExists($values, 'bio');
        $this->bio = $values['bio'];

        Assert::keyExists($values, 'socials');
        Assert::allKeyExists($values['socials'], 'icon');
        Assert::allKeyExists($values['socials'], 'name');

        $this->socials = \array_map(
            static fn (array $social) => new Social($social['icon'], $social['name']),
            $values['socials'],
        );
    }
}
