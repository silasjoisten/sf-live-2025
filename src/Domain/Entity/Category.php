<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Value\Description;
use App\Domain\Value\Id\CategoryId;
use App\Domain\Value\Slug;
use App\Domain\Value\Title;

final readonly class Category
{
    public CategoryId $id;
    public Slug $slug;
    public string $name;
    public Title $title;
    public Description $description;

    public function __construct(array $values)
    {
        $this->id = new CategoryId($values['id']);
        $this->slug = new Slug($values['full_slug']);
        $values = $values['content'];
        $this->name = $values['name'];
        $this->title = new Title($values['title']);
        $this->description = new Description($values['description']);
    }
}
