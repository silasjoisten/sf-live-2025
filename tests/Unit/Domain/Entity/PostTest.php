<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Entity;

use App\Domain\Entity\Post;
use App\Factory\AuthorFactory;
use App\Factory\CategoryFactory;
use App\Factory\PostFactory;
use App\Tests\Unit\UnitTestCase;

final class PostTest extends UnitTestCase
{
    private static function response(array $parameters = [], array $content = []): array
    {
        $values = PostFactory::createOne($parameters);
        $values['content'] = \array_replace_recursive($values['content'], $content);

        return $values;
    }

    /**
     * @test
     */
    public function id(): void
    {
        $values = self::response([
            'id' => $expected = self::faker()->numberBetween(1),
        ]);

        self::assertSame($expected, (new Post($values))->id->value);
    }

    /**
     * @test
     */
    public function idKeyMustExist(): void
    {
        $values = self::response();
        unset($values['id']);

        self::expectException(\InvalidArgumentException::class);

        new Post($values);
    }

    /**
     * @test
     */
    public function slug(): void
    {
        $values = self::response([
            'full_slug' => $expected = self::faker()->slug(),
        ]);

        self::assertSame($expected, (new Post($values))->slug->value());
    }

    /**
     * @test
     */
    public function slugKeyMustExist(): void
    {
        $values = self::response();
        unset($values['full_slug']);

        self::expectException(\InvalidArgumentException::class);

        new Post($values);
    }

    /**
     * @test
     */
    public function title(): void
    {
        $values = self::response(content: [
            'title' => $expected = self::faker()->sentence(),
        ]);

        self::assertSame($expected, (new Post($values))->title->value);
    }

    /**
     * @test
     */
    public function titleKeyMustExist(): void
    {
        $values = self::response();
        unset($values['content']['title']);

        self::expectException(\InvalidArgumentException::class);

        new Post($values);
    }

    /**
     * @test
     */
    public function description(): void
    {
        $values = self::response(content: [
            'description' => $expected = self::faker()->text(),
        ]);

        self::assertSame($expected, (new Post($values))->description->value);
    }

    /**
     * @test
     */
    public function descriptionKeyMustExist(): void
    {
        $values = self::response();
        unset($values['content']['description']);

        self::expectException(\InvalidArgumentException::class);

        new Post($values);
    }

    /**
     * @test
     */
    public function author(): void
    {
        $values = self::response();
        $values['content']['author'] = AuthorFactory::createMany(1);
        $values['content']['author'][0]['content']['name'] = $expected = self::faker()->name();

        self::assertSame($expected, (new Post($values))->author->name);
    }

    /**
     * @test
     */
    public function authorKeyMustExist(): void
    {
        $values = self::response();
        unset($values['content']['author']);

        self::expectException(\InvalidArgumentException::class);

        new Post($values);
    }

    /**
     * @test
     */
    public function category(): void
    {
        $values = self::response();
        $values['content']['category'] = CategoryFactory::createMany(1);
        $values['content']['category'][0]['content']['name'] = $expected = self::faker()->word();

        self::assertSame($expected, (new Post($values))->category->name);
    }

    /**
     * @test
     */
    public function categoryKeyMustExist(): void
    {
        $values = self::response();
        unset($values['content']['category']);

        self::expectException(\InvalidArgumentException::class);

        new Post($values);
    }
}
