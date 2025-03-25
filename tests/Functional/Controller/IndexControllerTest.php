<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Tests\Functional\FunctionalTestCase;
use Symfony\Component\HttpFoundation\Response;

final class IndexControllerTest extends FunctionalTestCase
{
    /**
     * @test
     */
    public function unauthenticatedUserCanVisitPage(): void
    {
        $this->browser()
            ->visit('/')
            ->assertSuccessful()
            ->assertSee('Welcome to MyBlog');
    }

    /**
     * @test
     */
    public function unauthenticatedUserOnFirstPageCanAdvance(): void
    {
        $this->browser()
            ->visit('/')
            ->assertSuccessful()
            ->assertElementCount('article.card', 8)
            ->assertSeeElement('span.prev')
            ->assertNotSeeElement('a.prev')
            ->assertSeeElement('a.next')

            ->click('a.next')
            ->assertSuccessful()
            ->assertOn('/?page=2')
            ->assertElementCount('article.card', 1)
            ->assertSeeElement('a.prev')
            ->assertNotSeeElement('a.next')
            ->assertSeeElement('span.next');
    }

    /**
     * @test
     */
    public function unauthenticatedUserOnLastPageCanGoBack(): void
    {
        $this->browser()
            ->visit('/?page=2')
            ->assertSuccessful()
            ->assertSee('Welcome to MyBlog')
            ->assertElementCount('article.card', 1)
            ->assertSeeElement('a.prev')
            ->assertNotSeeElement('span.prev')
            ->assertSeeElement('span.next')
            ->assertNotSeeElement('a.next')

            ->click('a.prev')
            ->assertSuccessful()
            ->assertOn('/?page=1')
            ->assertElementCount('article.card', 8);
    }
}
