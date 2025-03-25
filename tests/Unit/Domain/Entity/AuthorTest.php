<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Entity;

use App\Domain\Entity\Author;
use App\Factory\AuthorFactory;
use App\Tests\Unit\UnitTestCase;

final class AuthorTest extends UnitTestCase
{
    private static function response(array $parameters = [], array $content = []): array
    {
        $values = AuthorFactory::createOne($parameters);
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

        self::assertSame($expected, (new Author($values))->id->value);
    }

    /**
     * @test
     */
    public function idKeyMustExist(): void
    {
        $values = self::response();
        unset($values['id']);

        self::expectException(\InvalidArgumentException::class);

        new Author($values);
    }

    /**
     * @test
     */
    public function slug(): void
    {
        $values = self::response([
            'full_slug' => $expected = self::faker()->slug(),
        ]);

        self::assertSame($expected, (new Author($values))->slug->value);
    }

    /**
     * @test
     */
    public function slugKeyMustExist(): void
    {
        $values = self::response();
        unset($values['full_slug']);

        self::expectException(\InvalidArgumentException::class);

        new Author($values);
    }

    /**
     * @test
     */
    public function name(): void
    {
        $values = self::response(content: [
            'name' => $expected = self::faker()->sentence(),
        ]);

        self::assertSame($expected, (new Author($values))->name);
    }

    /**
     * @test
     */
    public function nameKeyMustExist(): void
    {
        $values = self::response();
        unset($values['content']['name']);

        self::expectException(\InvalidArgumentException::class);

        new Author($values);
    }

    /**
     * @test
     */
    public function bio(): void
    {
        $values = self::response(content: [
            'bio' => $expected = self::faker()->text(),
        ]);

        self::assertSame($expected, (new Author($values))->bio);
    }

    /**
     * @test
     */
    public function bioKeyMustExist(): void
    {
        $values = self::response();
        unset($values['content']['bio']);

        self::expectException(\InvalidArgumentException::class);

        new Author($values);
    }

    /**
     * @test
     */
    public function socials(): void
    {
        $values = self::response();

        self::assertCount(\count($values['content']['socials']), (new Author($values))->socials);
    }

    /**
     * @test
     */
    public function socialsKeyMustExist(): void
    {
        $values = self::response();
        unset($values['content']['socials']);

        self::expectException(\InvalidArgumentException::class);

        new Author($values);
    }

    /**
     * @test
     */
    public function socialsNameAllKeyMustExist(): void
    {
        $values = self::response();
        $values['content']['socials'] = [
            [
                'name' => self::faker()->sentence(),
                'icon' => self::faker()->word(),
            ],
            [
                'icon' => self::faker()->word(),
            ],
        ];

        self::expectException(\InvalidArgumentException::class);

        new Author($values);
    }

    /**
     * @test
     */
    public function socialsIconAllKeyMustExist(): void
    {
        $values = self::response();
        $values['content']['socials'] = [
            [
                'icon' => self::faker()->word(),
            ],
            [
                'name' => self::faker()->sentence(),
                'icon' => self::faker()->word(),
            ],
        ];

        self::expectException(\InvalidArgumentException::class);

        new Author($values);
    }
}
