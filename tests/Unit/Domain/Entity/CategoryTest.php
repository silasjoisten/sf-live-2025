<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Entity;

use App\Domain\Entity\Category;
use App\Factory\CategoryFactory;
use App\Tests\Unit\UnitTestCase;

final class CategoryTest extends UnitTestCase
{
    private static function response(array $parameters = [], array $content = []): array
    {
        $values = CategoryFactory::createOne($parameters);
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

        self::assertSame($expected, (new Category($values))->id->value);
    }

    /**
     * @test
     */
    public function idKeyMustExist(): void
    {
        $values = self::response();
        unset($values['id']);

        self::expectException(\InvalidArgumentException::class);

        new Category($values);
    }

    /**
     * @test
     */
    public function slug(): void
    {
        $values = self::response([
            'full_slug' => $expected = self::faker()->slug(),
        ]);

        self::assertSame($expected, (new Category($values))->slug->value);
    }

    /**
     * @test
     */
    public function slugKeyMustExist(): void
    {
        $values = self::response();
        unset($values['full_slug']);

        self::expectException(\InvalidArgumentException::class);

        new Category($values);
    }

    /**
     * @test
     */
    public function name(): void
    {
        $values = self::response(content: [
            'name' => $expected = self::faker()->sentence(),
        ]);

        self::assertSame($expected, (new Category($values))->name);
    }

    /**
     * @test
     */
    public function nameKeyMustExist(): void
    {
        $values = self::response();
        unset($values['content']['name']);

        self::expectException(\InvalidArgumentException::class);

        new Category($values);
    }

    /**
     * @test
     */
    public function title(): void
    {
        $values = self::response(content: [
            'title' => $expected = self::faker()->sentence(),
        ]);

        self::assertSame($expected, (new Category($values))->title->value);
    }

    /**
     * @test
     */
    public function titleKeyMustExist(): void
    {
        $values = self::response();
        unset($values['content']['title']);

        self::expectException(\InvalidArgumentException::class);

        new Category($values);
    }

    /**
     * @test
     */
    public function description(): void
    {
        $values = self::response(content: [
            'description' => $expected = self::faker()->text(),
        ]);

        self::assertSame($expected, (new Category($values))->description->value);
    }

    /**
     * @test
     */
    public function descriptionKeyMustExist(): void
    {
        $values = self::response();
        unset($values['content']['description']);

        self::expectException(\InvalidArgumentException::class);

        new Category($values);
    }
}
