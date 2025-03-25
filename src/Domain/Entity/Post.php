<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Value\Description;
use App\Domain\Value\Id\PostId;
use App\Domain\Value\Image;
use App\Domain\Value\RichText;
use App\Domain\Value\Slug;
use App\Domain\Value\Title;
use Webmozart\Assert\Assert;

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
        Assert::keyExists($values, 'id');
        $this->id = new PostId($values['id']);

        Assert::keyExists($values, 'full_slug');
        $this->slug = new Slug($values['full_slug']);

        Assert::keyExists($values, 'content');
        $values = $values['content'];

        Assert::keyExists($values, 'title');
        $this->title = new Title($values['title']);

        Assert::keyExists($values, 'description');
        $this->description = new Description($values['description']);

        Assert::keyExists($values, 'image');
        Assert::keyExists($values['image'], 'filename');
        Assert::keyExists($values['image'], 'alt');
        $this->image = new Image($values['image']['filename'], $values['image']['alt']);

        Assert::keyExists($values, 'author');
        Assert::isList($values['author']);
        Assert::count($values['author'], 1);
        $this->author = new Author($values['author'][0]);

        Assert::keyExists($values, 'category');
        Assert::isList($values['category']);
        Assert::count($values['category'], 1);

        $this->category = new Category($values['category'][0]);

        Assert::keyExists($values, 'content');
        $this->content = new RichText($values['content']);
    }
}
