<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Value\Description;
use App\Domain\Value\Id\CategoryId;
use App\Domain\Value\Slug;
use App\Domain\Value\Title;
use Webmozart\Assert\Assert;

final readonly class Category
{
    public CategoryId $id;
    public Slug $slug;
    public string $name;
    public Title $title;
    public Description $description;

    public function __construct(array $values)
    {
        Assert::keyExists($values, 'id');
        $this->id = new CategoryId($values['id']);

        Assert::keyExists($values, 'full_slug');
        $this->slug = new Slug($values['full_slug']);

        Assert::keyExists($values, 'content');
        $values = $values['content'];

        Assert::keyExists($values, 'name');
        $this->name = $values['name'];

        Assert::keyExists($values, 'title');
        $this->title = new Title($values['title']);

        Assert::keyExists($values, 'description');
        $this->description = new Description($values['description']);
    }
}
