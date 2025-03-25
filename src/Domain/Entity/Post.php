<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Value\Description;
use App\Domain\Value\Id\PostId;
use App\Domain\Value\Image;
use App\Domain\Value\RichText;
use App\Domain\Value\Slug;
use App\Domain\Value\Title;

final readonly class Post
{
    public PostId $id;
    public Slug $slug;
    public Title $title;
    public Description $description;
    public Author $author;
    public Category $category;
    public RichText $content;
    public Image $image;

    public function __construct(array $values)
    {
        $this->id = new PostId($values['id']);
        $this->slug = new Slug($values['full_slug']);
        $values = $values['content'];
        $this->title = new Title($values['title']);
        $this->description = new Description($values['description']);
        $this->author = new Author($values['author'][0]);
        $this->category = new Category($values['category'][0]);
        $this->content = new RichText($values['content']);
        $this->image = new Image($values['image']['filename'], $values['image']['alt']);
    }
}
